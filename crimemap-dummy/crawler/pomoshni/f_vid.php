<?php

function kd($zbor)
{
    if (
            mb_strpos($zbor, "КД", null, "UTF-8") === 0 ||
            mb_strpos($zbor, "кривично", null, "UTF-8") === 0 ||
            mb_strpos($zbor, "Кривично", null, "UTF-8") === 0 ||
            mb_strpos($zbor, "кривични", null, "UTF-8") === 0)
        return TRUE;
}

function polni_array_krivicni_dela()
{
    global $pistol, $boks, $kradec, $dokumenti, $kola, $droga;
    $pistol = array();
    $myFile = './kluchni_zborovi/krivichen_zakonik/pistol.txt';
    $fh = fopen($myFile, 'r') or die("ne moze da se otvori fajlot");
    while (($red = fgets($fh)) !== FALSE)
    {
        array_push($pistol, $red);
    }
    fclose($fh);
    $boks = array();
    $myFile = './kluchni_zborovi/krivichen_zakonik/boks.txt';
    $fh = fopen($myFile, 'r') or die("ne moze da se otvori fajlot");
    while (($red = fgets($fh)) !== FALSE)
    {
        array_push($boks, $red);
    }
    fclose($fh);

    $kradec = array();
    $myFile = './kluchni_zborovi/krivichen_zakonik/kradec.txt';
    $fh = fopen($myFile, 'r') or die("ne moze da se otvori fajlot");
    while (($red = fgets($fh)) !== FALSE)
    {
        array_push($kradec, $red);
    }
    fclose($fh);

    $dokumenti = array();
    $myFile = './kluchni_zborovi/krivichen_zakonik/dokumenti.txt';
    $fh = fopen($myFile, 'r') or die("ne moze da se otvori fajlot");
    while (($red = fgets($fh)) !== FALSE)
    {
        array_push($dokumenti, $red);
    }
    fclose($fh);

    $droga = array();
    $myFile = './kluchni_zborovi/krivichen_zakonik/droga.txt';
    $fh = fopen($myFile, 'r') or die("ne moze da se otvori fajlot");
    while (($red = fgets($fh)) !== FALSE)
    {
        array_push($droga, $red);
    }
    fclose($fh);

    $kola = array();
    $myFile = './kluchni_zborovi/krivichen_zakonik/kola.txt';
    $fh = fopen($myFile, 'r') or die("ne moze da se otvori fajlot");
    while (($red = fgets($fh)) !== FALSE)
    {
        array_push($kola, $red);
    }
    fclose($fh);
}

function kd_info($kd_plus, &$n)
{
    global $pistol, $boks, $kradec, $dokumenti, $droga, $kola;
    $kd_plus_string = implode(" ", $kd_plus);
    $delo_zbor = array();
    $najdov = FALSE;
    foreach ($kola as $k)
    {
        $k = trim($k);
        $krivicno_delo_poz = strpos($kd_plus_string, $k);
        if ($krivicno_delo_poz === FALSE)
            $krivicno_delo_poz = strpos($kd_plus_string, mb_strtoupper(substr($k, 0, 2), 'UTF-8') . substr($k, 2));
        if ($krivicno_delo_poz !== FALSE)
        {
            $delo = 5;
            $najdov = TRUE;
        }
    }

    if (!$najdov)
    {
        foreach ($boks as $b)
        {
            $b = trim($b);
            $krivicno_delo_poz = strpos($kd_plus_string, $b);
            if ($krivicno_delo_poz === FALSE)
                $krivicno_delo_poz = strpos($kd_plus_string, mb_strtoupper(substr($b, 0, 2), 'UTF-8') . substr($b, 2));
            if ($krivicno_delo_poz !== FALSE)
            {
                $delo = 1;
                $najdov = TRUE;
            }
        }
    }

    if (!$najdov)
    {
        foreach ($kradec as $k)
        {
            $k = trim($k);
            $krivicno_delo_poz = strpos($kd_plus_string, $k);
            if ($krivicno_delo_poz === FALSE)
                $krivicno_delo_poz = strpos($kd_plus_string, mb_strtoupper(substr($k, 0, 2), 'UTF-8') . substr($k, 2));
            if ($krivicno_delo_poz !== FALSE)
            {
                $delo = 2;
                $najdov = TRUE;
            }
        }
    }

    if (!$najdov)
    {
        foreach ($dokumenti as $dok)
        {
            $dok = trim($dok);
            $krivicno_delo_poz = strpos($kd_plus_string, $dok);
            if ($krivicno_delo_poz === FALSE)
                $krivicno_delo_poz = strpos($kd_plus_string, mb_strtoupper(substr($dok, 0, 2), 'UTF-8') . substr($dok, 2));
            if ($krivicno_delo_poz !== FALSE)
            {
                $delo = 3;
                $najdov = TRUE;
            }
        }
    }

    if (!$najdov)
    {
        foreach ($droga as $dro)
        {
            $dro = trim($dro);
            $krivicno_delo_poz = strpos($kd_plus_string, $dro);
            if ($krivicno_delo_poz === FALSE)
                $krivicno_delo_poz = strpos($kd_plus_string, mb_strtoupper(substr($dro, 0, 2), 'UTF-8') . substr($dro, 2));
            if ($krivicno_delo_poz !== FALSE)
            {

                $delo = 4;
                $najdov = TRUE;
            }
        }
    }

    if (!$najdov)
    {
        foreach ($pistol as $p)
        {
            $p = trim($p);
            $krivicno_delo_poz = strpos($kd_plus_string, $p);
            if ($krivicno_delo_poz === FALSE)
                $krivicno_delo_poz = strpos($kd_plus_string, mb_strtoupper(substr($p, 0, 2), 'UTF-8') . substr($p, 2));
            if ($krivicno_delo_poz !== FALSE)
            {
                $delo = 0;
                $najdov = TRUE;
            }
        }
    }
    if ($najdov)
    {
        $d = $delo;
        $delo_zbor["zbor"] = $kd_plus_string;
    }
    else
    {
        $d = FALSE;
    }
    $delo_zbor["delo"] = $d;
    return $delo_zbor;
}

function polni_array_opshti()
{
    global $opsht_pistol, $opsht_boks, $opsht_kradec, $opsht_dokumenti, $opsht_droga, $opsht_kola;

    $opsht_pistol = array();
    $myFile = './kluchni_zborovi/opshto/pistol.txt';
    $fh = fopen($myFile, 'r') or die("ne moze da se otvori fajlot");
    while (($red = fgets($fh)) !== FALSE)
    {
        array_push($opsht_pistol, $red);
    }
    fclose($fh);

    $opsht_boks = array();
    $myFile = './kluchni_zborovi/opshto/boks.txt';
    $fh = fopen($myFile, 'r') or die("ne moze da se otvori fajlot");
    while (($red = fgets($fh)) !== FALSE)
    {
        array_push($opsht_boks, $red);
    }
    fclose($fh);

    $opsht_kradec = array();
    $myFile = './kluchni_zborovi/opshto/kradec.txt';
    $fh = fopen($myFile, 'r') or die("ne moze da se otvori fajlot");
    while (($red = fgets($fh)) !== FALSE)
    {
        array_push($opsht_kradec, $red);
    }
    fclose($fh);

    $opsht_dokumenti = array();
    $myFile = './kluchni_zborovi/opshto/dokumenti.txt';
    $fh = fopen($myFile, 'r') or die("ne moze da se otvori fajlot");
    while (($red = fgets($fh)) !== FALSE)
    {
        array_push($opsht_dokumenti, $red);
    }
    fclose($fh);

    $opsht_droga = array();
    $myFile = './kluchni_zborovi/opshto/droga.txt';
    $fh = fopen($myFile, 'r') or die("ne moze da se otvori fajlot");
    while (($red = fgets($fh)) !== FALSE)
    {
        array_push($opsht_droga, $red);
    }
    fclose($fh);

    $opsht_kola = array();
    $myFile = './kluchni_zborovi/opshto/kola.txt';
    $fh = fopen($myFile, 'r') or die("ne moze da se otvori fajlot");
    while (($red = fgets($fh)) !== FALSE)
    {
        array_push($opsht_kola, $red);
    }
    fclose($fh);
}

function opsht($zbor)
{
    global $opsht_pistol, $opsht_boks, $opsht_kradec, $opsht_dokumenti, $opsht_droga, $opsht_kola;
    $delo = FALSE;
    $najdov = FALSE;
    $delo_zbor = array();
    foreach ($opsht_pistol as $p)
    {
        $p = trim($p);
        if (($kluchen_zbor_poz = mb_strpos($zbor, $p, null, "UTF-8")) !== FALSE)
        {
            $delo = 0;
            $najdov = TRUE;
        }
    }

    if (!$najdov)
    {
        foreach ($opsht_boks as $b)
        {
            $b = trim($b);
            if (($kluchen_zbor_poz = mb_strpos($zbor, $b, null, "UTF-8")) !== FALSE)
            {
                $delo = 1;
                $najdov = TRUE;
            }
        }
    }

    if (!$najdov)
    {
        foreach ($opsht_kradec as $k)
        {
            $k = trim($k);
            if (($kluchen_zbor_poz = mb_strpos($zbor, $k, null, "UTF-8")) !== FALSE)
            {
                $delo = 2;
                $najdov = TRUE;
            }
        }
    }

    if (!$najdov)
    {
        foreach ($opsht_dokumenti as $d)
        {
            $d = trim($d);
            if (($kluchen_zbor_poz = mb_strpos($zbor, $d, null, "UTF-8")) !== FALSE)
            {
                $delo = 3;
                $najdov = TRUE;
            }
        }
    }

    if (!$najdov)
    {
        foreach ($opsht_droga as $d)
        {
            $d = trim($d);
            if (($kluchen_zbor_poz = mb_strpos($zbor, $d, null, "UTF-8")) !== FALSE)
            {
                $delo = 4;
                $najdov = TRUE;
            }
        }
    }

    if (!$najdov)
    {
        foreach ($opsht_kola as $k)
        {
            $k = trim($k);
            if (($kluchen_zbor_poz = mb_strpos($zbor, $k, null, "UTF-8")) !== FALSE)
            {
                $delo = 5;
                $najdov = TRUE;
            }
        }
    }
    if ($najdov)
    {
        $d = $delo;
        $delo_zbor["zbor"] = $zbor;
    }
    else
    {
        $d = FALSE;
    }
    $delo_zbor["delo"] = $d;
    return $delo_zbor;
}

?>
