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
            <script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>
            <script type="text/javascript" src="../js/jquery-ui-1.8.22.custom.min.js"></script>
            <link rel="stylesheet" href="../css/smoothness/jquery-ui-1.8.20.custom.css" type="text/css">
            <script type="text/javascript">
                function smeni(){
                    var email = $('#email').val();
                    var password = $('#password').val();
                    var password2 = $('#password2').val();
                    if(password2 == password){
                        $.post("ajax.php", {tip: 5, email: email, password: password}, function(data){
                            if(data=='')
                                location.href="administratori.php";
                        });
                    }
                    else{
                        alert("Вредностите на двете лозинки не се исти.")
                    }
                }
            </script>
        <?php
        require '../config/connect.php';
        require 'header.php';
        $id = $_SESSION['admin'];
        $konekcija = new Konekcija();
        $result = $konekcija->query("SELECT * FROM admini WHERE admin_id='" . $id . "';");
        $red = mysql_fetch_row($result);
        ?>
    </head>
    <body>
        <div id="content" style="margin: 0 auto; width: 310px;">
        <?php
        if ($red != NULL)
            echo "<div style='padding: 5px 0;'>" . $red[1] . ", го разгледувате вашиот профил.</div>";
        ?>
        <table>
            <tr><td>
                    Ново корисничко име:</td> <td> <input id="email" type="text" name="email" value="<?php echo $red[1] ?>"/></td>
            </tr>
            <tr><td>
                    Нова лозинка:</td> <td> <input id="password" type="password" name="password"/></td>
            </tr>
            <tr><td>
                    Нова лозинка (2):</td> <td> <input id="password2" type="password" name="password2"/></td>
            </tr>
            <tr><td>
                    <button id="smeni" onclick="smeni()">Смени</button>
                </td></tr>
        </table>
            </div>
    </body>
</html>
<?php } ?>
