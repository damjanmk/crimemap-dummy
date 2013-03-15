<?php

function mkd_vo_mysql_datum($mkd_datum)
{
    $den = substr($mkd_datum, 0, 2);
    $mesec = substr($mkd_datum, 3, 2);
    $godina = substr($mkd_datum, 6, 4);
    return $godina . '-' . $mesec . '-' . $den;
}

function mysql_vo_mkd_datum($mysql_datum)
{
    $godina = substr($mysql_datum, 0, 4);
    $mesec = substr($mysql_datum, 5, 2);
    $den = substr($mysql_datum, 8, 2);
    return $den . "." . $mesec . "." . $godina;
}

function datum($zbor)
{
    if (preg_match("/(0[1-9]|[12][0-9]|3[01]).(0[1-9]|1[012]).(19|20)\d\d/", $zbor))
    {
        return TRUE;
    }
    return FALSE;
}

function datum_vchera($datum)
{
    return date("Y-m-d", strtotime($datum) - 86400);
}

?>
