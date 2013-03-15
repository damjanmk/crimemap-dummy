<?php
if(!isset($_SESSION))
{
    session_start();
} 
if (!isset($_SESSION['admin']))
{
    header("Location: ./login.php?greska=1");
}
else
{
?>
    <html>
        <head>
            <link rel="stylesheet" href="../css/admin/main.css" type="text/css">
            <link rel="stylesheet" href="../css/admin/administratori.css" type="text/css">
            <script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>
            <script type="text/javascript" src="../js/jquery-ui-1.8.22.custom.min.js"></script>
            <link rel="stylesheet" href="../css/smoothness/jquery-ui-1.8.20.custom.css" type="text/css">
        <?php
        require '../config/connect.php';
        require 'header.php';
        ?>
    </head>
    <body>
        Се планира и изработува...
    </body>
</html>
<?php } ?>