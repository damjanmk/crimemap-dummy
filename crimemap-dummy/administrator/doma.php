<?php
require '../config/connect.php';
session_start();
if (!isset($_SESSION['admin']))
{
    $nema = TRUE;
    if (isset($_POST['email']) && isset($_POST['password']))
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        if ($email != NULL && $password != NULL)
        {
            $konekcija = new Konekcija();
            $result = $konekcija->query("SELECT * FROM admini");
            while ($row = mysql_fetch_assoc($result))
            {
                if ($email == $row['email'] && md5($password) == $row['password'])
                {
                    $nema = FALSE;
                    $_SESSION['admin'] = $row['admin_id'];
                }
            }
        }
        if ($nema)
        {
            header("Location: ./login.php?greska=1");
        }
    }
    else
    {
        header("Location: ./login.php");
    }
}
if (isset($_SESSION['admin']))
{
    include_once 'header.php';
    $konekcija = new Konekcija();
    $result = $konekcija->query("SELECT COUNT(1) FROM nastani");
    $red = mysql_fetch_row($result);
    $br_torki = $red[0];
    $str_max = ceil($br_torki / 30);
    $sort = '';
    $nasoka = "DESC";
    if (isset($_GET['n']))
        $nasoka = $_GET['n'];
    if (isset($_GET['sort']))
        $sort = $_GET['sort'];
    if (isset($_GET['str']) && preg_match("~^\d+$~", $_GET['str']))
    {
        $str = $_GET['str'];
    }
    else
    {
        $str = 1;
    }
?>
    <html>
        <head>
            <link rel="stylesheet" href="../css/admin/main.css" type="text/css">
            <link rel="stylesheet" href="../css/admin/doma.css" type="text/css">
            <script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>
            <script type="text/javascript" src="../js/jquery-ui-1.8.20.custom.min.js"></script>
            <link rel="stylesheet" href="../css/smoothness/jquery-ui-1.8.20.custom.css" type="text/css">
            <script type="text/javascript">
                $(function(){
                    $('.smeni').click(function(){
                        var id = $("div.select").attr('id');
                        if(!id){
                            $('#stavka').dialog({modal: true,
                                buttons: {
                                    Ok: function() {
                                        $( this ).dialog( "close" );
                                    }
                                }
                            });
                            return;
                        }
                        $('#formular_shto').val( $('#shto_' + id).text()  );
                        $('#formular_grad').val( $('#grad_' + id).text()  );
                        $('#formular_adresa').val( $('#adresa_' + id).text()  );
                        $('#formular_bilten').val( $('#bilten_' + id).text()  );
                        $('#formular_datum').val( $('#datum_' + id).text()  );
                        $('#formular_lat').val( $('#lat_' + id).text()  );
                        $('#formular_lng').val( $('#lng_' + id).text()  );
                        $('#formular_opis').val( $('#opis_' + id).text()  );

                        $( "#dialog-formular" ).dialog({
                            height: 600,
                            width: 500,
                            modal: true,
                            buttons: {
                                "Потврди промени": function() {
                                    azhuriraj(id);
                                    $( this ).dialog( "close" );
                                },
                                "Откажи": function() {
                                    $( this ).dialog( "close" );
                                }
                            }
                        });
                    });

                    $('.brishi').click(function(){
                        var id = $("div.select").attr('id');
                        if(!id){
                            $('#stavka').dialog({modal: true,
                                buttons: {
                                    Ok: function() {
                                        $( this ).dialog( "close" );
                                    }
                                }
                            });
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

                    $('#tabela tr').click(function(){
                        $('tr').removeClass('select_red');
                        $(this).addClass('select_red');
                        $('.id').removeClass('select');
                        $(this).find('.id').addClass('select');
                    });

                });
                function brishi(id){
                    $.get("ajax.php", {tip:1, id: id}, function(data){
                        if(data=='')
                            location.reload(true);
                    });
                }
                function azhuriraj(id){
                    var shto = $('#formular_shto').val();
                    var grad = $('#formular_grad').val();
                    var adresa = $('#formular_adresa').val();
                    var datum_bilten = $('#formular_bilten').val();
                    var datum = $('#formular_datum').val();
                    var lat = $('#formular_lat').val();
                    var lng = $('#formular_lng').val();
                    var opis = $('#formular_opis').val();
                    $.post("ajax.php", {tip:2, id: id, shto: shto, grad: grad, adresa: adresa, datum_bilten : datum_bilten, datum: datum, lat:lat, lng:lng, opis: opis}, function(data){
                        if(data=='')
                            location.reload(true);
                        else
                            alert(data);
                    });
                }
            </script>

        </head>
        <body>
            <div id="stavka" title="Грешка!" style="font-size:14px; display:none;">Ве молиме селектирајте ставка.</div>
        <?php
        $id = $_SESSION['admin'];
        $result = $konekcija->query("SELECT * FROM admini WHERE admin_id='" . $id . "';");
        if (($red = mysql_fetch_row($result)) != NULL)
            echo "<div style='padding:5px 0; text-align: center'>" . $red[1] . ", добредојдовте</div>";
        echo "<div class='clear_both'></div>";
        echo "<div class='str'><div>Прикажани се до 30 ставки од стр:<div style='height: 5px;'></div>";
        echo "<a href='?sort=" . $sort . "&str=1'> |<< </a>";
        if ($str == 1)
            echo "<a class='ne_moze'> < </a>";
        else
            echo "<a href='?sort=" . $sort . "&str=" . ($str - 1) . "'> < </a>";
        if ($str <= 6)
        {
            $i = 1;
            $j = 10;
        }
        else if ($str + 5 > $str_max)
        {
            $i = $str_max - 9;
            $j = $str_max;
        }
        else
        {
            $i = $str - 5;
            $j = $str + 5;
        }
        for (; $i <= $j; $i++)
        {
            if ($i == $str)
                echo "<a class='tekovna' href='?sort=" . $sort . "&str=" . $i . "'> " . $i . " </a>";
            else
                echo "<a href='?sort=" . $sort . "&str=" . $i . "'> " . $i . " </a>";
        }
        if ($str == $str_max)
            echo "<a class='ne_moze'> ></a>";
        else
            echo "<a href='?sort=" . $sort . "&str=" . ($str + 1) . "' > ></a>";
        echo "<a href='?sort=" . $sort . "&str=" . $str_max . "'> >>| </a>";
        echo "</div></div>";
        $pocetok = 30 * ($str - 1);
        $kraj = 30 * $str;
        $select = "SELECT * FROM nastani";
        if ($sort != NULL)
        {
            $select .= " ORDER BY " . $sort . " " . $nasoka;
            if ($nasoka == "ASC")
                $nasoka = "DESC";
            else
                $nasoka = "ASC";
        }
        ?>
        <div class="kopchninja">
            <button class="smeni">Смени</button>
            <button class="brishi">Бриши</button>
        </div>
        <div id="naslovi">
            <a id="id" href="?sort=nastan_id&str=<?php echo $str; ?>&n=<?php echo $nasoka; ?>">id</a>
            <a id="tip" href="?sort=shto&str=<?php echo $str; ?>&n=<?php echo $nasoka; ?>">тип</a>
            <a id="grad" href="?sort=grad&str=<?php echo $str; ?>&n=<?php echo $nasoka; ?>">град</a>
            <a id="adresa" href="?sort=adresa&str=<?php echo $str; ?>&n=<?php echo $nasoka; ?>">адреса</a>
            <a id="datum_bilten" href="?sort=datum_bilten&str=<?php echo $str; ?>&n=<?php echo $nasoka; ?>">датум(билтен)</a>
            <a id="datum" href="?sort=datum&str=<?php echo $str; ?>&n=<?php echo $nasoka; ?>">датум</a>
            <a id="lat" href="?sort=lat&str=<?php echo $str; ?>&n=<?php echo $nasoka; ?>">lat</a>
            <a id="lng" href="?sort=lng&str=<?php echo $str; ?>&n=<?php echo $nasoka; ?>">lng</a>
            <a id="opis" href="?sort=opis&str=<?php echo $str; ?>&n=<?php echo $nasoka; ?>">опис</a>
        </div>
        <div id="dialog-brishi" title="Последна проверка!" >
            <p><span style="float:left; margin:0 7px 20px 0;" class="ui-icon ui-icon-alert"></span>Избриши засекогаш?</p>
        </div>
        <div id="dialog-formular" title="Ажурирање">
            <p><span style="float:left; margin:0 7px 20px 0;"></span>Променете ги соодветните вредности.</p>
            <form id="formular">
                <fieldset>
                    <table>
                        <tr>
                            <td>Што: </td>
                            <td><input id="formular_shto" type="text" name="shto"/></td>
                        </tr>
                        <tr>
                            <td>Град:</td>
                            <td><input id="formular_grad" type="text" name="grad"/></td>
                        </tr>
                        <tr>
                            <td>Адреса:</td>
                            <td><input id="formular_adresa" type="text" name="adresa"/></td>
                        </tr>
                        <tr>
                            <td>Датум(билтен):</td>
                            <td><input id="formular_bilten" type="text" name="datum_bilten"/></td>
                        </tr>
                        <tr>
                            <td>Датум:</td>
                            <td><input id="formular_datum" type="text" name="datum"/></td>
                        </tr>
                        <tr>
                            <td colspan="2">За точни lat/lng, притиснете <a href="www.gorissen.info/Pierre/maps/googleMapLocation.php?lat=41.654308&lon=21.566162&setLatLon=Set" target="_blank">овде</a>.</td>
                        </tr>
                        <tr>
                            <td>lat:</td>
                            <td><input id="formular_lat" type="text" name="lat"/></td>
                        </tr>
                        <tr>
                            <td>lng:</td>
                            <td><input id="formular_lng" type="text" name="lng"/></td>
                        </tr>
                        <tr>
                            <td>Опис:</td>
                            <td><textarea id="formular_opis" rows="10" name="opis"></textarea></td>
                        </tr>
                    </table>
                </fieldset>
            </form>
        </div>
        <?php
        $select .= " LIMIT " . $pocetok . ", " . $kraj;
        $result = $konekcija->query($select);
        echo mysql_error();
        echo "<div class='scroll'><table id='tabela'><tbody>";
        while ($row = mysql_fetch_assoc($result))
        {
            $id = $row['nastan_id'];
            echo "<tr>";
            echo "<td><div class='id' id='" . $id . "'>" . $id . "</div></td>";
            echo "<td><div class='shto' id='shto_" . $id . "'>" . $row['shto'] . "</div></td>";
            echo "<td><div class='grad' id='grad_" . $id . "'>" . $row['grad'] . "</div></td>";
            echo "<td><div class='adresa' id='adresa_" . $id . "'>" . $row['adresa'] . "</div></td>";
            echo "<td><div class='datum' id='bilten_" . $id . "'>" . $row['datum_bilten'] . "</div></td>";
            echo "<td><div class='datum' id='datum_" . $id . "'>" . $row['datum'] . "</div></td>";
            echo "<td><div class='lat' id='lat_" . $id . "'>" . $row['lat'] . "</div></td>";
            echo "<td><div class='lng' id='lng_" . $id . "'>" . $row['lng'] . "</div></td>";
            echo "<td><textarea class='opis' rows=5 readonly='readonly' id='opis_" . $id . "'>" . $row['opis'] . "</textarea></td>";
            echo "</tr>";
        }
        echo "</tbody></table></div>";
        ?><div class="kopchninja">
            <button class="smeni">Смени</button>
            <button class="brishi">Бриши</button>
        </div>
        <?php
        echo "<div class='str'><div>Прикажани се до 30 ставки од стр:<div style='height: 5px;'></div>";
        echo "<a href='?sort=" . $sort . "&str=1'> |<< </a>";
        if ($str == 1)
            echo "<a class='ne_moze'> < </a>";
        else
            echo "<a href='?sort=" . $sort . "&str=" . ($str - 1) . "'> < </a>";
        if ($str <= 6)
        {
            $i = 1;
            $j = 10;
        }
        else if ($str + 5 > $str_max)
        {
            $i = $str_max - 9;
            $j = $str_max;
        }
        else
        {
            $i = $str - 5;
            $j = $str + 5;
        }
        for (; $i <= $j; $i++)
        {
            if ($i == $str)
                echo "<a class='tekovna' href='?sort=" . $sort . "&str=" . $i . "'> " . $i . " </a>";
            else
                echo "<a href='?sort=" . $sort . "&str=" . $i . "'> " . $i . " </a>";
        }
        if ($str == $str_max)
            echo "<a class='ne_moze'> ></a>";
        else
            echo "<a href='?sort=" . $sort . "&str=" . ($str + 1) . "' > ></a>";
        echo "<a href='?sort=" . $sort . "&str=" . $str_max . "'> >>| </a>";
        echo "</div></div>";
        ?>
    </body>
</html>
<?php
    }
?>