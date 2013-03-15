<?php

require '../config/connect.php';
$konekcija = new Konekcija();
$id = $_POST['id'];
$shto = $_POST['shto'];
$grad = $_POST['grad'];
$adresa = mysql_real_escape_string($_POST['adresa']);
$datum_bilten = mysql_real_escape_string($_POST['datum_bilten']);
$datum = mysql_real_escape_string($_POST['datum']);
$lat = mysql_real_escape_string($_POST['lat']);
$lng = mysql_real_escape_string($_POST['lng']);
$opis = mysql_real_escape_string($_POST['opis']);
$result = $konekcija->query("INSERT INTO prijaveni_greski SET nastan_id='" . $id . "', shto='" . $shto . "', grad='" . $grad . "', adresa='" . $adresa . "', datum_bilten='" . $datum_bilten . "', datum='" . $datum . "', lat='" . $lat . "', lng='" . $lng . "', opis='" . $opis . "';");
echo mysql_error();
?>
