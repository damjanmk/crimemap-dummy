<?php

require_once '../config/dbconfig.php';
$dbhost = get_host();
$dbuser = get_username();
$dbpwd = get_password();
$dbname = get_database();

Header("Content-type: application/octet-stream");

Header("Content-Disposition: attachment; filename=crimemap_nastani.sql");

echo passthru("/usr/bin/mysqldump --opt --host=$dbhost --user=$dbuser --password=$dbpwd $dbname --skip-comments --ignore-table=crimemap.admini --ignore-table=crimemap.prijaveni_greski ");

exit;
?>