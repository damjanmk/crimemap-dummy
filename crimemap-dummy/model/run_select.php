<?php
require_once '../config/dbfields.php';
require_once '../config/connect.php';

if (isset($_GET['sql'])) {
    $sql = $_GET['sql'];
    $field41 = 'opis';
    $field42 = 'id';
    $field43 = 'datum_bilten';
    $field44 = 'lng';
    $field45 = 'lat';
    $field46 = 'slika';    
    $json = array();
    $konekcija = new Konekcija();
    
    $result = $konekcija->query($sql);

    while ($row = mysql_fetch_assoc($result)) {
        $nastan_id = $row[get_field_id()];
        $shto = $row[get_field_type()];
        $datum_bilten = $row[get_field_date_issue()];
        $opis = trim($row[get_field_description()]);
        $lat = $row[get_field_latitude()];
        $lng = $row[get_field_longitude()];

        if (isset($lat) && isset($lng) && $lat != 0 && $lng != 0 && $opis != "") {
            $nastan = array();
            $nastan[$field41] = $opis;
            $nastan[$field42] = $nastan_id;
            $nastan[$field43] = $datum_bilten;
            $nastan[$field44] = $lng;
            $nastan[$field45] = $lat;
            $nastan[$field46] = $shto;
            array_push($json, $nastan);
        }
    }
} else {
    $json = "{'error': 'sql not isset'}";
}
echo json_encode($json);
?>