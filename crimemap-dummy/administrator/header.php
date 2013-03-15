<?php
if (!isset($_SESSION))
{
    session_start();
}
$najaven = FALSE;
if (isset($_SESSION['admin']))
{
    $najaven = TRUE;
}
?>
<link rel="stylesheet" href="../css/admin/header.css" type="text/css" >
<div id="header">
    <div id="title_div">
    Карта на криминалот на Македонија
    <a href="#" id="open_data_logo"><img alt="Open Data Logo" src="../img/open_data.png"></a>
</div>
    <div class="clear_both"></div>
    <div id="menu">
        <ul id="ul_menu">
            <li><a id="doma" href="doma.php">Дома (цела база)</a></li>
            <li><a id="greski" href="greski.php">Пријавени грешки</a></li>
            <li><a id="administratori" href="administratori.php">Администратори</a></li>
            <li><a id="vrski" href="vrski.php">Врски</a></li>
            <li><a id="jazici" href="jazici.php">Јазици</a></li>
            <li><a id="profil" href="profil.php">Профил</a></li>            
        </ul>
        <?php if($najaven){ ?>
        <div id="odjava">
            <a href="odjava.php">Одјави се</a>
        </div>
        <?php } else { ?>
        <div id="najava">
            <a href="login.php">Најави се</a>
        </div>
        <?php } ?>
    </div>
</div>
<div class="clear_both"></div>