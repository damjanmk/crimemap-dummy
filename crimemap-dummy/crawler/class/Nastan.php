<?php
require '../config/connect.php';
class Nastan
{

    private $shto;
    private $grad;
    private $adresa;
    private $datum_bilten;
    private $datum;
    private $opis;
    private $lat;
    private $lng;

    public function get_lat()
    {
        return $this->lat;
    }

    public function set_lat($lat)
    {
        $this->lat = $lat;
    }

    public function get_lng()
    {
        return $this->lng;
    }

    public function set_lng($lng)
    {
        $this->lng = $lng;
    }

    function __construct($datum_bilten, $opis)
    {
        $this->datum_bilten = $datum_bilten;
        $this->opis = $opis;
    }

    public function get_shto_delo()
    {
        return $this->shto["delo"];
    }

    public function get_shto_zbor()
    {
        return $this->shto["zbor"];
    }

    public function set_shto($shto)
    {
        $this->shto = $shto;
    }

    public function get_grad()
    {
        return $this->grad;
    }

    public function set_grad($grad)
    {
        $this->grad = $grad;
    }

    public function get_adresa()
    {
        return $this->adresa;
    }

    public function set_adresa($adresa)
    {
        $this->adresa = $adresa;
    }

    public function get_datum_bilten()
    {
        return $this->datum_bilten;
    }

    public function set_datum_bilten($datum_bilten)
    {
        $this->datum_bilten = $datum_bilten;
    }

    public function get_datum()
    {
        return $this->datum;
    }

    public function set_datum($datum)
    {
        $this->datum = $datum;
    }

    public function get_opis()
    {
        return $this->opis;
    }

    public function set_opis($opis)
    {
        $this->opis = $opis;
    }

    public function nema_adresa()
    {
        return $this->adresa == null ? TRUE : FALSE;
    }

    public function nema_grad()
    {
        return $this->grad == null ? TRUE : FALSE;
    }

    public function nema_shto()
    {
        return $this->shto == null ? TRUE : FALSE;
    }

    public function nema_datum()
    {
        return $this->datum == null ? TRUE : FALSE;
    }

    public function ima_se()
    {
        if (
                $this->shto != null &&
                $this->adresa != null &&
                $this->grad != null &&
                $this->datum != null
        )
            return TRUE;
    }

    public function insert_in_db()
    {
        $konekcija = new Konekcija();
        $konekcija->query_insert("INSERT INTO nastani (shto, grad, adresa, datum_bilten, datum, opis, lat, lng) VALUES ( '" . $this->get_shto_delo() . "', '" . $this->get_grad() . "', '" . $this->get_adresa() . "', '" . $this->get_datum_bilten() . "', '" . $this->get_datum() . "', '" . $this->get_opis() . "', '" . $this->get_lat() . "', '" . $this->get_lng() . "' );");
        echo mysql_error();
    }

    public function get_nastan()
    {
        return "Заклучок:\n\t<<датум на билтен = " . $this->get_datum_bilten() .
        " >>\n\t<<што = " . $this->get_shto_delo() . ", зборот = „" . $this->get_shto_zbor() . "“" .
        " >>\n\t<<град = " . $this->get_grad() .
        " >>\n\t<<адреса = " . $this->get_adresa() .
        " >>\n\t<<датум = " . $this->get_datum() .
        " >>\n\t<<lat = " . $this->get_lat() .
        " >>\n\t<<lng = " . $this->get_lng() .
        " >>";
    }

}

?>
