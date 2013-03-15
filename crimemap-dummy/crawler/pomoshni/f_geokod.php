<?php

function get_lat1($bounds)
{
    //41.29,22.43|42.13,23.27
    $i = strpos($bounds, ",");
    return substr($bounds, 0, $i);
}

function get_lat2($bounds)
{
    //41.29,22.43|42.13,23.27
    $i = strpos($bounds, "|");
    $s = substr($bounds, $i + 1);
    $i = strpos($bounds, ",");
    return substr($s, 0, $i);
}

function get_lng1($bounds)
{
    //41.29,22.43|42.13,23.27
    $i = strpos($bounds, "|");
    $j = strpos($bounds, ",");
    return substr($bounds, $j + 1, $i - $j - 1);
}

function get_lng2($bounds)
{
    //41.29,22.43|42.13,23.27
    $i = strpos($bounds, "|");
    $s = substr($bounds, $i + 1);
    $i = strpos($bounds, ",");
    return substr($s, $i + 1);
}

function geokod(&$n)
{
    global $bounds_grad;
    $g = !$n->nema_grad();
    $a = !$n->nema_adresa();
    if ($g)
    {
        $grad = $n->get_grad();
        $bounds = $bounds_grad[$grad];
        if ($a)
        {
            //g, a
            $adresa = $n->get_adresa();
            $addr = urlencode($adresa . ", Macedonia");
            $url = 'http://maps.google.com/maps/geo?q=' . $addr . '&output=csv&sensor=false&regoin=mk&bounds=' . $bounds;
            $get = file_get_contents($url);
            $records = explode(",", $get);
            if ($records['0'] == 200)
            {
                $lat = $records['2'];
                $lng = $records['3'];
                if ($lat < get_lat1($bounds) || $lat > get_lat2($bounds) || $lng < get_lng1($bounds) || $lng > get_lng2($bounds))
                {
                    $adresa = $adresa . ", " . $grad;
                    $addr = urlencode($adresa . ", Macedonia");
                    $url = 'http://maps.google.com/maps/geo?q=' . $addr . '&output=csv&sensor=false&regoin=mk&bounds=' . $bounds;
                    $get = file_get_contents($url);
                    $records = explode(",", $get);
                    if ($records['0'] == 200)
                    {
                        $lat = $records['2'];
                        $lng = $records['3'];
                        if ($lat < get_lat1($bounds) || $lat > get_lat2($bounds) || $lng < get_lng1($bounds) || $lng > get_lng2($bounds))
                        {
                            //ja dava lnglat za gradot
                            $latlng = substr($bounds, 0, strpos($bounds, "|"));
                            $zapirka = strpos($bounds, ",");
                            $lat_t = substr($latlng, 0, $zapirka);
                            $lng_t = substr($latlng, $zapirka + 1);
                            $lat = (float) $lat_t + 0.42;
                            $lng = (float) $lng_t + 0.42;
                        }
                    }
                    else
                    {
                        $latlng = substr($bounds, 0, strpos($bounds, "|"));
                        $zapirka = strpos($bounds, ",");
                        $lat_t = substr($latlng, 0, $zapirka);
                        $lng_t = substr($latlng, $zapirka + 1);
                        $lat = (float) $lat_t + 0.42;
                        $lng = (float) $lng_t + 0.42;
                    }
                }
            }
            else
            {
                $adresa = $adresa . ", " . $grad;
                $addr = urlencode($adresa . ", Macedonia");
                $url = 'http://maps.google.com/maps/geo?q=' . $addr . '&output=csv&sensor=false&regoin=mk&bounds=' . $bounds;
                $get = file_get_contents($url);
                $records = explode(",", $get);
                if ($records['0'] == 200)
                {
                    $lat = $records['2'];
                    $lng = $records['3'];
                    if ($lat < get_lat1($bounds) || $lat > get_lat2($bounds) || $lng < get_lng1($bounds) || $lng > get_lng2($bounds))
                    {
                        //ja dava lnglat za gradot
                        $latlng = substr($bounds, 0, strpos($bounds, "|"));
                        $zapirka = strpos($bounds, ",");
                        $lat_t = substr($latlng, 0, $zapirka);
                        $lng_t = substr($latlng, $zapirka + 1);
                        $lat = (float) $lat_t + 0.42;
                        $lng = (float) $lng_t + 0.42;
                    }
                }
                else
                {
                    $latlng = substr($bounds, 0, strpos($bounds, "|"));
                    $zapirka = strpos($bounds, ",");
                    $lat_t = substr($latlng, 0, $zapirka);
                    $lng_t = substr($latlng, $zapirka + 1);
                    $lat = (float) $lat_t + 0.42;
                    $lng = (float) $lng_t + 0.42;
                }
            }
        }
        else
        {
            //g, ne a
//ja dava lnglat za gradot
            $latlng = substr($bounds, 0, strpos($bounds, "|"));
            $zapirka = strpos($bounds, ",");
            $lat_t = substr($latlng, 0, $zapirka);
            $lng_t = substr($latlng, $zapirka + 1);
            $lat = (float) $lat_t + 0.42;
            $lng = (float) $lng_t + 0.42;
        }
    }
    else if ($a)
    {
        //ne g, a
        $addr = urlencode($n->get_adresa() . ", Macedonia");
        $url = 'http://maps.google.com/maps/geo?q=' . $addr . '&output=csv&sensor=false&regoin=mk'; //$bounds=' . $bounds;
        $get = file_get_contents($url);
        $records = explode(",", $get);
        if ($records['0'] == 200)
        {
            $lat = $records['2'];
            $lng = $records['3'];
        }
    }
    else
    {
        //ne g, ne a
        $n->set_lat(41);
        $n->set_lng(18);
        return 0;
    }
    if (isset($lat) && isset($lng))
    {
        $n->set_lat($lat);
        $n->set_lng($lng);
        return 1;
    }
    return -1;
}

?>
