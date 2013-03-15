<?php
ini_set( "display_errors", 0);
function mysql_vo_mkd_datum($mysql_datum)
{
    $godina = substr($mysql_datum, 0, 4);
    $mesec = substr($mysql_datum, 5, 2);
    $den = substr($mysql_datum, 8, 2);
    return $den . "." . $mesec . "." . $godina;
}

function getSlika($shto)
{
    switch ($shto)
    {
        case 0:
            return "пиштол";
        case 1:
            return "насилство";
        case 2:
            return "кражба";
        case 3:
            return "документи";
        case 4:
            return "дрога";
        case 5:
            return "сообраќај";
        default:
            return "друго";
    }
}

require '../config/connect.php';

$vrska = new Konekcija();
$resultat = $vrska->Query("SELECT nastan_id, shto, grad," /* adresa, */ . " datum, lat, lng, opis FROM nastani");

$implementation = new DOMImplementation();
//$dtd = $implementation->createDocumentType('dtd', '', 'nastani.dtd');
//$dom = $implementation->createDocument('', '', $dtd);
//$dom = $implementation->createDocument('', '');
$dom = new DomDocument('1.0', 'UTF-8');
//$dom->encoding = "UTF-8";

$koren = $dom->createElement("nastani");
$koren = $dom->appendChild($koren);
while ($red = mysql_fetch_assoc($resultat))
{
    $nastan = $dom->createElement("nastan");
    $nastan = $koren->appendChild($nastan);

    $nastan->appendChild($dom->createElement('nastan_id', $red['nastan_id']));
    $nastan->appendChild($dom->createElement('shto', getSlika($red['shto'])));
    $nastan->appendChild($dom->createElement('grad', $red['grad']));
    //$nastan->appendChild($dom->createElement('adresa', $red['adresa']));
    $nastan->appendChild($dom->createElement('datum', mysql_vo_mkd_datum($red['datum'])));
    $nastan->appendChild($dom->createElement('lat', $red['lat']));
    $nastan->appendChild($dom->createElement('lng', $red['lng']));
    $nastan->appendChild($dom->createElement('opis', $red['opis']));
}
Header("Content-Type: text/xml;");

Header("Content-Disposition: attachment; filename=crimemap_nastani.xml");

echo $dom->saveXML();

exit;
?>
