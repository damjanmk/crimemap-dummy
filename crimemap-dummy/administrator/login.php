<html>
    <head>
        <link rel="stylesheet" href="../css/admin/main.css" type="text/css">
        <?php
        include_once 'header.php';
        if (isset($_GET['greska']) && $_GET['greska'] != NULL)
        {
            $greska = $_GET['greska'];
        }
        ?>
    </head>
    <body>
        <div class="clear_both" style="height: 5px;"></div>
        <?php
        if (isset($greska))
        {
            if ($greska == 1)
                echo "<div style='background-color: white; text-align: center; color: red; text-decoration: underline;'>Администратор со тие генералии не беше пронајден во базата.</div>";
        }
        ?>
        <div class="clear_both" style="height: 5px;"></div>
        <form style="width: 270px; margin: 0 auto;" method="post" action="doma.php">
            <div id="korisnichko_ime">
                Email: <input name="email" type="text" style="margin-left: 22px;"/>
            </div>
            <div id="lozinka">
                Лозинка:
                <input name="password" type="password"/>
            </div>
            <button type="submit" style="float: right;">Најави се</button>
        </form>
    </body>
</html>