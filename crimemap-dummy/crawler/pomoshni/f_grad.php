<?php

function polni_array_grad()
{
    global $grad_mapa, $bounds_grad;
    $grad_mapa = array();
    $bounds_grad = array();
    $myFile = './kluchni_zborovi/gradovi.txt';
    $fh = fopen($myFile, 'r') or die("ne moze da se otvori fajlot");
    while (($red = fgets($fh)) !== false)
    {
        $tire = strpos($red, "-");
        $grad = substr($red, 0, $tire);
        $dolna = strpos($red, "_");
        $gradsko = substr($red, $tire + 1, $dolna - $tire - 1);
        $bounds = trim(substr($red, $dolna + 1));
        $grad_mapa[$grad] = $gradsko;
        $bounds_grad[$grad] = $bounds;
    }
    fclose($fh);
//print_r($bounds_grad);
}

function grad($zbor)
{
    global $grad_mapa;
    foreach ($grad_mapa as $grad => $gradsko)
    {
        if (mb_strpos($grad, $zbor, null, "UTF-8") === 0)
        {
            return $grad;
        }
        else if (mb_strpos($zbor, $grad, null, "UTF-8") !== FALSE)
        {
            return $grad;
        }
        if (mb_strpos($gradsko, $zbor, null, "UTF-8") === 0)
        {
            return $grad;
        }
        else if (mb_strpos($zbor, $gradsko, null, "UTF-8") !== FALSE)
        {
            return $grad;
        }
    }
    return FALSE;
}

?>
