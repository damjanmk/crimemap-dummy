<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <link rel="stylesheet" href="../css/admin/main.css" type="text/css">
            <link rel="stylesheet" href="../css/admin/doma.css" type="text/css">
            <link rel="stylesheet" href="../css/admin/greski.css" type="text/css">
            <script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>
            <script type="text/javascript" src="../js/jquery-ui-1.8.22.custom.min.js"></script>
            <link rel="stylesheet" href="../css/smoothness/jquery-ui-1.8.22.custom.css" type="text/css">
            
            <?php
            require '../config/connect.php';
            session_start();
            if (isset($_SESSION['admin']))
            {
                require 'header.php';
                $konekcija = new Konekcija();
                $result = $konekcija->query("SELECT COUNT(1) FROM prijaveni_greski");
                $red = mysql_fetch_row($result);
                $br_torki = $red[0];

                $str_max = ceil($br_torki / 30);
                if (isset($_GET['str']) && preg_match("~^\d+$~", $_GET['str']))
                {
                    $str = $_GET['str'];
                }
                else
                {
                    $str = 1;
                }
            ?>

            <script type="text/javascript">
                $(function(){
                    $('#tabela tr').click(function(){
                        $('tr').removeClass('select_red');
                        $(this).addClass('select_red');
                        $('.id').removeClass('select');
                        $(this).find('.id').addClass('select');
                        var id = $(this).find('.select').attr('id');

                        $('#treba_shto').text( $('#shto_' + id).text()  );
                        $('#treba_grad').text( $('#grad_' + id).text()  );
                        $('#treba_adresa').text( $('#adresa_' + id).text()  );
                        $('#treba_bilten').text( $('#bilten_' + id).text()  );
                        $('#treba_datum').text( $('#datum_' + id).text()  );
                        $('#treba_lat').text( $('#lat_' + id).text()  );
                        $('#treba_lng').text( $('#lng_' + id).text()  );
                        $('#treba_opis').text( $('#opis_' + id).text()  );

                        tekoven(id);

                        $( "#dialog-formular" ).dialog({
                            height: 600,
                            width: 815,
                            modal: true,
                            buttons: {
                                "Прифати (ажурирај па бриши од база)": function() {
                                    azhuriraj(id);
                                    $( this ).dialog( "close" );
                                },
                                "Одбиј (бриши од база)": function() {
                                    brishi_greska(id);
                                    $( this ).dialog( "close" );
                                },
                                "Откажи": function() {
                                    $( this ).dialog( "close" );
                                }
                            }
                        });
                    });
                });
                function tekoven(id){
                    $.get("ajax.php", {tip:6, id: id}, function(data){
                        var json = eval('(' + data + ')');                        
                        $('#stoi_shto').text( json.shto  );
                        $('#stoi_grad').text( json.grad  );
                        $('#stoi_adresa').text( json.adresa  );
                        $('#stoi_bilten').text( json.datum_bilten  );
                        $('#stoi_datum').text( json.datum  );
                        $('#stoi_lat').text( json.lat  );
                        $('#stoi_lng').text( json.lng  );
                        $('#stoi_opis').text( json.opis );
                    });
                }
                function azhuriraj(id){
                    var shto = $('#treba_shto').text();
                    var grad = $('#treba_grad').text();
                    var adresa = $('#treba_adresa').text();
                    var datum_bilten = $('#treba_bilten').text();
                    var datum = $('#treba_datum').text();
                    var lat = $('#treba_lat').text();
                    var lng = $('#treba_lng').text();
                    var opis = $('#treba_opis').text();
                    $.post("ajax.php", {tip:2, id: id, shto: shto, grad: grad, adresa: adresa, datum_bilten : datum_bilten, datum: datum, lat:lat, lng:lng, opis: opis}, function(data){
                        if(data!='')
                            alert(data);
                    });
                    brishi(id);
                }
                function brishi_greska(id){
                    $.get("ajax.php", {tip:7, id: id}, function(data){
                        if(data=='')
                            location.reload(true);
                    });
                }
            </script>
        </head>
        <body>            
        <?php
        $id = $_SESSION['admin'];
        $result = $konekcija->query("SELECT * FROM admini WHERE admin_id='" . $id . "';");
        if (($red = mysql_fetch_row($result)) != NULL)
            echo "<div style='padding:5px 0; text-align: center'>" . $red[1] . ", добредојдовте</div>";
        echo "<div class='clear_both'></div>";
        echo "<div class='str'><div>Прикажани се до 30 ставки од стр:<div style='height: 5px;'></div>";
        echo "<a href='?str=1'> |<< </a>";
        if ($str == 1)
            echo "<a class='ne_moze'> < </a>";
        else
            echo "<a href='?str=" . ($str - 1) . "'> < </a>";
        if ($str <= 6)
        {
            $i = 1;
            if($str_max < 10)
                $j = $str_max;
            else
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
                echo "<a class='tekovna' href='?str=" . $i . "'> " . $i . " </a>";
            else
                echo "<a href='?str=" . $i . "'> " . $i . " </a>";
        }
        if ($str == $str_max)
            echo "<a class='ne_moze'> ></a>";
        else
            echo "<a href='?str=" . ($str + 1) . "' > ></a>";
        echo "<a href='?str=" . $str_max . "'> >>| </a>";
        echo "</div></div>";
        ?>
        <div id="naslovi">
            <a id="id">id</a>
            <a id="tip">тип</a>
            <a id="grad">град</a>
            <a id="adresa">адреса</a>
            <a id="datum_bilten">датум(билтен)</a>
            <a id="datum">датум</a>
            <a id="lat">lat</a>
            <a id="lng">lng</a>
            <a id="opis">опис</a>
        </div>
        <div id="dialog-brishi" title="Последна проверка!" >
            <p><span style="float:left; margin:0 7px 20px 0;" class="ui-icon ui-icon-alert"></span>Избриши засекогаш?</p>
        </div>
        <div id="dialog-formular" title="Ажурирање">
            <p><span style="float:left; margin:0 7px 20px 0;"></span>Левата табела го покажува тековниот запис, а десната соодветната поправка.</p>
            <table id="stoi">
                <tr>
                    <th colspan="2">Стои</th>
                </tr>
                <tr>
                    <td>Што: </td>
                    <td><div id="stoi_shto" ></div></td>
                </tr>
                <tr>
                    <td>Град:</td>
                    <td><div id="stoi_grad" ></div></td>
                </tr>
                <tr>
                    <td>Адреса:</td>
                    <td><div id="stoi_adresa" ></div></td>
                </tr>
                <tr>
                    <td>Датум (билтен):</td>
                    <td><div id="stoi_bilten" ></div></td>
                </tr>
                <tr>
                    <td>Датум:</td>
                    <td><div id="stoi_datum" ></div></td>
                </tr>
                <tr>
                    <td><br /></td>
                    <td><br /></td>
                </tr>
                <tr>
                    <td>lat:</td>
                    <td><div id="stoi_lat" ></div></td>
                </tr>
                <tr>
                    <td>lng:</td>
                    <td><div id="stoi_lng" ></div></td>
                </tr>
                <tr>
                    <td>Опис:</td>
                    <td><textarea id="stoi_opis" rows="10" ></textarea></td>
                </tr>
            </table>
            <table id="treba">
                <tr>
                    <th colspan="2">Треба</th>
                </tr>
                <tr>
                    <td>Што: </td>
                    <td><div id="treba_shto" ></div></td>
                </tr>
                <tr>
                    <td>Град:</td>
                    <td><div id="treba_grad" ></div></td>
                </tr>
                <tr>
                    <td>Адреса:</td>
                    <td><div id="treba_adresa" ></div></td>
                </tr>
                <tr>
                    <td>Датум (билтен):</td>
                    <td><div id="treba_bilten" ></div></td>
                </tr>
                <tr>
                    <td>Датум:</td>
                    <td><div id="treba_datum" ></div></td>
                </tr>
                <tr>
                    <td colspan="2">За точни lat/lng, притиснете <a href="www.gorissen.info/Pierre/maps/googleMapLocation.php?lat=41.654308&lon=21.566162&setLatLon=Set" target="_blank">овде</a>.</td>
                </tr>
                <tr>
                    <td>lat:</td>
                    <td><div id="treba_lat" ></div></td>
                </tr>
                <tr>
                    <td>lng:</td>
                    <td><div id="treba_lng" ></div></td>
                </tr>
                <tr>
                    <td>Опис:</td>
                    <td><textarea id="treba_opis" rows="10" ></textarea></td>
                </tr>
            </table>
        </div>
        <?php
        $pocetok = 30 * ($str - 1);
        $kraj = 30 * $str;
        $result = $konekcija->query("SELECT * FROM prijaveni_greski LIMIT " . $pocetok . ", " . $kraj);
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
        echo "<div class='str'><div>Прикажани се до 30 ставки од стр:<div style='height: 5px;'></div>";
        echo "<a href='?str=1'> |<< </a>";
        if ($str == 1)
            echo "<a class='ne_moze'> < </a>";
        else
            echo "<a href='?str=" . ($str - 1) . "'> < </a>";
        if ($str <= 6)
        {
            $i = 1;
            if($str_max < 10)
                $j = $str_max;
            else
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
                echo "<a class='tekovna' href='?str=" . $i . "'> " . $i . " </a>";
            else
                echo "<a href='?str=" . $i . "'> " . $i . " </a>";
        }
        if ($str == $str_max)
            echo "<a class='ne_moze'> ></a>";
        else
            echo "<a href='?str=" . ($str + 1) . "' > ></a>";
        echo "<a href='?str=" . $str_max . "'> >>| </a>";
        echo "</div></div>";
        ?>
    </body>
</html>
<?php
    }
	else
	{
    header("Location: ./login.php?greska=1");
	}
?>