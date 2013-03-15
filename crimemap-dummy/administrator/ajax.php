<?php
/**
 * called asynchronously.
 * makes queries to the database, depenting on the request argiment 'tip'
 * basic delete and update sruff
 */
require '../config/connect.php';
if (isset($_REQUEST['tip']) && preg_match("~^\d$~", $_REQUEST['tip']))
{
    $tip = $_REQUEST['tip'];
    $konekcija = new Konekcija();
    switch ($tip)
    {
        case 1:
            $id = $_GET['id'];
            $result = $konekcija->query("DELETE FROM nastani WHERE nastan_id = '" . $id . "';");
            return mysql_error();
        case 2:
            $id = $_POST['id'];
            $shto = $_POST['shto'];
            $grad = $_POST['grad'];
            $adresa = $_POST['adresa'];
            $datum_bilten = $_POST['datum_bilten'];
            $datum = $_POST['datum'];
            $lat = $_POST['lat'];
            $lng = $_POST['lng'];
            $opis = $_POST['opis'];
            $result = $konekcija->query("UPDATE nastani SET shto='" . mysql_escape_string($shto) . "', grad='" . mysql_escape_string($grad) . "', adresa='" . mysql_escape_string($adresa) . "', datum_bilten='" . mysql_escape_string($datum_bilten) . "', datum='" . mysql_escape_string($datum) . "', lat='" . mysql_escape_string($lat) . "', lng='" . mysql_escape_string($lng) . "', opis='" . mysql_escape_string($opis) . "' WHERE nastan_id='" . $id . "'");
            return mysql_error(); 
        case 3:
            $id = $_GET['id'];
            $result = $konekcija->query("DELETE FROM admini WHERE admin_id = '" . $id . "';");
            return mysql_error();
        case 4:
            $email = $_POST['email'];
            $password = $_POST['password'];
            $result = $konekcija->query("INSERT INTO admini (email, password) VALUES ('" . mysql_escape_string($email) . "', '" . md5(mysql_escape_string($password)) . "');");
            return mysql_error();
        case 5:
            if(!isset($_SESSION))
            {
                session_start();
                $id = $_SESSION['admin'];
            }
            $email = $_POST['email'];
            $password = $_POST['password'];
            if($password != NULL && $email!= NULL)
                $result = $konekcija->query("UPDATE admini SET email='" . mysql_escape_string($email) . "', password='" . md5(mysql_escape_string($password)) . "' WHERE admin_id ='" . $id . "';");
            else if($password == NULL)
                $result = $konekcija->query("UPDATE admini SET email='" . mysql_escape_string($email) . "' WHERE admin_id ='" . $id . "';");
            if($email == NULL)
                $result = $konekcija->query("UPDATE admini SET password='" . md5(mysql_escape_string($password)) . "' WHERE admin_id ='" . $id . "';");
            return mysql_error();
        case 6:
            $m = array();
            $id = $_GET['id'];
            $result = $konekcija->query("SELECT * FROM nastani WHERE nastan_id='" . $id . "';");
            echo mysql_error();
            if (($row = mysql_fetch_assoc($result)) != NULL)
                $m = $row;
            echo json_encode($m);
            break;
        case 7:            
            $id = $_GET['id'];
            $result = $konekcija->query("DELETE FROM prijaveni_greski WHERE nastan_id = '" . $id . "';");
            return mysql_error();
    }
}
else
    return;