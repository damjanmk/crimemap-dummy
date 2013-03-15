<?php
/**
 * if there's no logged in administrator in session
 * redirect to login, else show the page with administrator info
 * Note; every administrator can delete all the administrators!
 * all info in macedonian
 */
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
            <link rel="stylesheet" href="../css/smoothness/jquery-ui-1.8.22.custom.css" type="text/css">
        <?php
        require '../config/connect.php';
        require 'header.php';
        ?>
        <script type="text/javascript">
            $(function(){
                $('.brishi').click(function(){
                    var id = $("td.select").html();
                    if(!id){
                        alert("Ве молиме селектирајте ставка.");
                        return;
                    }
                    $( "#dialog-brishi" ).dialog({
                        resizable: false,
                        height:160,
                        modal: true,
                        buttons: {
                            "Да. Бриши.": function() {
                                brishi(id);
                                $( this ).dialog( "close" );
                            },
                            "Не, не!": function() {
                                $( this ).dialog( "close" );
                            }
                        }
                    });
                });

                $('table tr').click(function(){
                    $('tr').removeClass('select_red');
                    $(this).addClass('select_red');
                    $('.id').removeClass('select');
                    $(this).find('.id').addClass('select');
                });

            });
            function brishi(id){
                $.get("ajax.php", {tip:3, id: id}, function(data){
                    if(data=='')
                        location.reload(true);
                    else
                        alert(data);
                });
            }
            function dodaj(){
                var email = $('#email').val();
                var password = $('#password').val();
                $.post("ajax.php", {tip: 4, email: email, password: password}, function(data){
                    if(data=='')
                        location.reload(true);
                    else
                        alert(data);
                })
            }
        </script>
    </head>
    <body>        
        <div id="dialog-brishi" title="Последна проверка!">
            <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Дали сакате да го избришете овој запис засекогаш?</p>
        </div>
        <div id="content">
            <?php
            $id = $_SESSION['admin'];
            $konekcija = new Konekcija();
            $result = $konekcija->query("SELECT * FROM admini WHERE admin_id='" . $id . "';");
            if (($red = mysql_fetch_row($result)) != NULL)
                echo "<div style='style='padding: 5px 0;'>" . $red[1] . ", тука може да менаџирате со другите администратори</div>";
            ?>
            <div id="div_dodaj">
                <h2>Додај нов администратор</h2>
                <div class="clear_both"></div>
                <div>
                    <span>Корисничко име на новиот администратор:</span>
                    <input id="email" type="text" name="email"/>
                </div>
                <div class="clear_both"></div>
                <div>
                    <span>Лозинка на новиот администратор:</span>
                    <input id="password" type="password" name="password"/>
                </div>
                <div class="clear_both"></div>
                <button id="dodaj" onclick="dodaj()">Додај</button>
                <div class="clear_both"></div>
            </div>
            <div class="clear_both" style="height: 50px;"></div>
            <div id="div_brishi">
                <h2>Бриши постоечки администратор</h2>
                <button class="brishi">Бриши</button>
                <table>
                    <tr>
                        <th>admin_id</th>
                        <th>email</th>
                    </tr>
                    <?php
                    $konekcija = new Konekcija();
                    $result = $konekcija->query("SELECT * FROM admini");
                    while ($red = mysql_fetch_assoc($result))
                    {
                    ?>
                        <tr>
                            <td class="id"><?php echo $red['admin_id'] ?></td>
                            <td><?php echo $red['email'] ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </body>
</html>
<?php } ?>