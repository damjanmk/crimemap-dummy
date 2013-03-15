<?php
//ini_set('memory_limit', '256M');
require './class/Logger.php';
require './class/Nastan.php';
require './pomoshni/f_grad.php';
require './pomoshni/f_adresa.php';
require './pomoshni/f_datum.php';
require './pomoshni/f_vid.php';
require './pomoshni/f_geokod.php';

function chitaj($id)
{
    $url = "http://www.moi.gov.mk/ShowAnnouncements.aspx?ItemID=" . $id . "&mid=1149&tabId=209&tabindex=0";
    //vo $html ja zema cela sodrzina od $url, @ e za da ne pokazhuva eden notice
    @$html = file_get_contents($url);
    if ($html !== FALSE)
        return $html;
    else
        return FALSE;
}

function e_bilten($html)
{
    //Obicno vaka se nasloveni dnevnite bilteni
    if ((strpos($html, "Извадок од дел од дневните настани") !== FALSE) ||
            (strpos($html, "Извадок на дел од дневните настани") !== FALSE) ||
            (strpos($html, "Ивадок на дел од дневните настани") !== FALSE) ||
            (strpos($html, "Извадок на дел од дневни настани") !== FALSE) ||
            (strpos($html, "Ивадок на дел од дневни настани") !== FALSE) ||
            (strpos($html, "Издавок на дел од дневните настани") !== FALSE)
    )
        return TRUE;
    else
        return FALSE;
}

function e_nastan($tekst)
{
    if (strlen($tekst) < 103 || strpos($tekst, "Извадок") !== FALSE || strpos($tekst, "Ивадок") !== FALSE || strpos($tekst, "Издавок") !== FALSE)
        return FALSE;
    else
        return TRUE;
}

function main($last_id)
{
	echo "NLP Script - Beginning... <br />";
    $log = new Logger('./log/Log');
//$id = 11069;
    for ($id = $last_id; $id < $last_id + 69; $id++)
    {
		echo ".";
        $html = chitaj($id);

        if ($html === FALSE)
        {
            $log->logWriteNewLine();
            $log->logWrite("!!!!!Грешка при читање од url за id: " . $id . "!!!!!");
        }
        else
        {
            if (!e_bilten($html))
            {
                $log->logWriteNewLine();
                $log->logWrite(" !!!!!Ставката со id: " . $id . " не е билтен. !!!!! ");
            }
            else
            {

                polni_array_grad();
                polni_array_opshti();
                polni_array_krivicni_dela();
                $log->logWriteNewLine();
                $log->logWrite("Нов билтен е пронајден! id: " . $id);
                $fp = fopen('./last.txt', 'w');
                    fwrite($fp, $id + 1);
                fclose($fp);
                $dom = new DOMDocument;
                @$dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', "UTF-8"));
                $xpath = new DOMXPath($dom);
                $datum_bilten = NULL;
                if (($datum_bilten_dom_list = $xpath->query("//span[@id='TitleField']") ) != null)
                {
                    $datum_bilten = $datum_bilten_dom_list->item(0)->nodeValue;
                    $datum_bilten = mkd_vo_mysql_datum($datum_bilten);
                }
                $paragrafi = $xpath->query("//div[@id='HtmlHolder']/p");
                //else $paragrafi = explode( xpath HtmlHolder/font, "<br>)
                foreach ($paragrafi as $paragraf)
                {
                    $tekst = trim($paragraf->nodeValue);
                    $tekst = trim($tekst, "\x20\x0d\xc2\xa0\n");
                    if (!e_nastan($tekst))
                    {
                        continue;
                    }
                    else
                    {
                        $log->logWriteNewLine();
                        $log->logWrite("Нов настан е пронајден.");
                        $log->logWrite(wordwrap("\n\t" . $tekst, 200, "\n\t"));
                        $n = new Nastan($datum_bilten, $tekst);
                        $array_opis = explode(" ", $tekst);
                        $array_opis_count = count($array_opis);
                        for ($i = 0; $i < $array_opis_count; $i++)
                        {
                            if ($n->ima_se())
                            {
                                break;
                            }
                            $zbor = trim($array_opis[$i], " ");
                            if ($zbor == "")
                                continue;
                            if ($n->nema_datum())
                            {
                                if (datum($zbor))
                                {
                                    $n->set_datum(mkd_vo_mysql_datum($zbor));
                                    continue;
                                }
                            }
                            if ($n->nema_adresa())
                            {
                                if (selo($zbor))
                                {
                                    selo_info(array_slice($array_opis, $i, 3), $n);
                                    continue;
                                }
                            }
                            if ($n->nema_adresa())
                            {
                                if (ul($zbor))
                                {
                                    ul_info(array_slice($array_opis, $i, 5), $n);
                                    continue;
                                }
                            }
                            if ($n->nema_grad())
                            {
                                if (($grad = grad($zbor)) !== FALSE)
                                {
                                    $n->set_grad($grad);
                                    continue;
                                }
                            }
                            if ($n->nema_shto())
                            {
                                $shto = opsht($zbor);
                                if ($shto["delo"] !== FALSE)
                                {
                                    $n->set_shto($shto);
                                    continue;
                                }
                            }
                            if ($n->nema_shto())
                            {
                                if (kd($zbor))
                                {
                                    if ($array_opis_count > $i + 16)
                                    {
                                        kd_info(array_slice($array_opis, $i, 16), $n);
                                    }
                                    else
                                    {
                                        kd_info(array_slice($array_opis, $i, $array_opis_count - $i), $n);
                                    }
                                    continue;
                                }
                            }
                        }

                        if ($n->nema_shto())
                        {
                            $shto = array();
                            $shto["delo"] = 6;
                            $shto["zbor"] = "!auto!";
                            $n->set_shto($shto);
                        }
                        if ($n->nema_datum() && $datum_bilten != NULL)
                        {
                            $n->set_datum(datum_vchera($datum_bilten));
                        }

                        geokod($n);

                        $log->logWrite($n->get_nastan());
                        $n->insert_in_db();
                    }
                }
            }
        }
    }
	echo "<br />NLP Script - Done";
}

$id = file_get_contents('./last.txt');
main($id);
?>
