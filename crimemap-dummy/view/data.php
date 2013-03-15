<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">        
        <link rel="stylesheet" href="../css/data.css" type="text/css">
        <link rel="stylesheet" href="../css/smoothness/jquery-ui-1.8.22.custom.css" type="text/css">
        <script type="text/javascript" src="../js/jquery-1.7.2.min.js"> </script>
        <script type="text/javascript" src="../js/jquery-ui-1.8.22.custom.min.js"></script>
        <script type="text/javascript"  src="../js/data.js"></script>               
    </head>
    <body>   
		<?php
        require '../config/connect.php';
        require '../config/dbfields.php';
        require '../functions/view.php';

        if (isset($_GET['l']) && $_GET['l'] != null)
        {	
			$l = $_GET['l'];
            if ($l == 'mk'){
                $format = "d.m.Y";
                echo "<script type='text/javascript' src='../js/jquery.ui.datepicker-mk.js'></script>";}
            else if ($l == 'en'){
                $format = "d/m/Y";
                echo "<script type='text/javascript' src='../js/jquery.ui.datepicker-en.js'></script>";}
            else if ($l == 'sq'){
                $format = "d.m.Y";
                echo "<script type='text/javascript' src='../js/jquery.ui.datepicker-sq.js'></script>";}
        }
        else{
            $format = "d.m.Y";
            echo "<script type='text/javascript' src='../js/jquery.ui.datepicker-mk.js'></script>";}
        
        $konekcija = new Konekcija();
        $result = $konekcija->query("SELECT COUNT(1) FROM " . get_field_table());
        $red = mysql_fetch_row($result);
        $br_torki = $red[0];
        $str_max = ceil($br_torki / 30);
        $nasoka = "DESC";
        if (isset($_GET['n']))
            $nasoka = $_GET['n'];
        $sort = '';
        if (isset($_GET['sort']))
            $sort = $_GET['sort'];
        if (isset($_GET['str']) )
        {
            $str = $_GET['str'];
        }
        else
        {
            $str = 1;
        }
        if (isset($_GET['nastan_id']))
        {
            $id = $_GET['nastan_id'];
            echo "<div style='display:none' id='nastan_id'>" . $id . "</div>";
            $str = (int) ($id / 30);
        }
		require 'header.php';
        ?>         
		<title><?php echo $lang['Crime Map Macedonia'];?></title>
        <div id="stavka" title="<?php echo $lang['Error!']; ?>" style="font-size:14px; display:none;"><?php echo $lang['Please select an item']; ?></div>
        <div id="ok" title="<?php echo $lang['Success!']; ?>" style="font-size:14px; display:none;"><?php echo $lang['The error was successfully reported. Thank you:)']; ?></div>
        <div class='top'></div>
        <div class='middle'>
            <div id='download_db'>
                <div><?php echo $lang['Download all the data']; ?></div>
                <div id='download_btns'>
                    <a class='download' href='../model/xmldump.php'>xml</a>
                    <a class='download' href='../model/mysqldump.php'>sql</a>
                </div>
            </div>
            <div class='clear'></div>
            <?php            
            echo "<div class='str'><div>" . $lang['Showing up to 30 items from page:'] . "<div style='height: 5px;'></div>";
            echo "<a href='?str=1";
            if($sort)
                echo "?sort=" . $sort;
                echo "&l=" . $l;
            echo "'> |<< </a>";
            if ($str == 1)
                echo "<a class='ne_moze'> < </a>";
            else
            {
                echo "<a href='?str=" . ($str - 1);
                if ($sort)
                    echo "&sort=" . $sort;
                    echo "&l=" . $l;
                echo "'> < </a>";
            }
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
                    echo "<a class='tekovna' href='#'> " . $i . " </a>";
                else
                {
                    echo "<a href='?str=" . $i;
                    if ($sort)
                        echo "&sort=" . $sort;
                        echo "&l=" . $l;
                    echo "'> " . $i . " </a>";
                }
            }
            if ($str == $str_max)
                echo "<a class='ne_moze'> ></a>";
            else{
                echo "<a href='?str=" . ($str + 1);
                if ($sort)
                        echo "&sort=" . $sort;
                        echo "&l=" . $l;
                echo "' > ></a>";
            }
            echo "<a href='?str=" . $str_max;
            if ($sort)
                echo "&sort=" . $sort;
                echo "&l=" . $l;
            echo "'> >>| </a>";
            echo "</div></div>";
            ?>
            <div id="search_div">
		<div id="search_img"><img src="../img/search-icon.png" alt="search-icon" /></div>                
		<input type="text" id="search" value="<?php if(isset($_GET['opis'])) echo $_GET['opis']; ?>"/>		
		<div id="search_desc"><?php echo $lang['description'] . ':' ?></div>
            </div>
            <div class="kopchninja">
                <button class="prijavi"><?php echo $lang['report']; ?></button>                
            </div>            
            <div class="clear"></div>
            <div id="naslovi">
                <a id="id" href="?str=<?php echo $str; ?>&sort=nastan_id<?php echo "&l=" . $l; ?>">id</a>
                <a id="tip" href="?str=<?php echo $str; ?>&sort=shto<?php echo "&l=" . $l; ?>"><?php echo $lang['type']; ?></a>
                <a id="grad" href="?str=<?php echo $str; ?>&sort=grad<?php echo "&l=" . $l; ?>"><?php echo $lang['city']; ?></a>
                <a id="adresa" href="?str=<?php echo $str; ?>&sort=adresa<?php echo "&l=" . $l; ?>"><?php echo $lang['address']; ?></a>
                <a id="datum_bilten" href="?str=<?php echo $str; ?>&sort=datum_bilten<?php echo "&l=" . $l; ?>"><?php echo $lang['date(bulletin)']; ?></a>
                <a id="datum" href="?str=<?php echo $str; ?>&sort=datum<?php echo "&l=" . $l; ?>"><?php echo $lang['date']; ?></a>
                <a id="lat" href="?str=<?php echo $str; ?>&sort=lat<?php echo "&l=" . $l; ?>"><?php echo $lang['lat']; ?></a>
                <a id="lng" href="?str=<?php echo $str; ?>&sort=lng<?php echo "&l=" . $l; ?>"><?php echo $lang['lng']; ?></a>
                <a id="opis" href="?str=<?php echo $str; ?>&sort=opis<?php echo "&l=" . $l; ?>"><?php echo $lang['description']; ?></a>
            </div>
            <div id="dialog-brishi" title="<?php echo $lang['Last check!']; ?>" >
                <p><span style="float:left; margin:0 7px 20px 0;" class="ui-icon ui-icon-alert"></span><?php echo $lang['Delete forever?']; ?></p>
            </div>
            <div id="dialog-formular" title="<?php echo $lang['report']; ?>" >
                <p><span style="float:left; margin:0 7px 20px 0;"></span><?php echo $lang['Change the values']; ?></p>
                <form id="formular">
                    <fieldset>
                        <table>
                            <tr>
                                <td><br /></td>
                                <td><br /></td>
                            </tr>
                            <tr>
                                <td><?php echo $lang['type']; ?>: </td>
                                <td><select id="formular_shto">
                                    <option value="0"><?php echo $lang['weapons']; ?></option>
                                    <option value="1"><?php echo $lang['violence']; ?></option>
                                    <option value="2"><?php echo $lang['theft']; ?></option>
                                    <option value="3"><?php echo $lang['documents']; ?></option>
                                    <option value="4"><?php echo $lang['drugs']; ?></option>
                                    <option value="5"><?php echo $lang['traffic']; ?></option>
                                    <option value="6"><?php echo $lang['other']; ?></option>
                                    </select></td>
                            </tr>
                            <tr>
                                <td><?php echo $lang['city']; ?>:</td>
                                <td>
                                    <select id="formular_grad">
                                        <option><?php echo $lang['Берово']; ?></option>
                                        <option><?php echo $lang['Битола']; ?></option>
                                        <option><?php echo $lang['Богданци']; ?></option>
                                        <option><?php echo $lang['Валандово']; ?></option>
                                        <option ><?php echo $lang['Велес']; ?></option>
                                        <option><?php echo $lang['Виница']; ?></option>
                                        <option ><?php echo $lang['Гевгелија']; ?></option>
                                        <option><?php echo $lang['Гостивар']; ?></option>
                                        <option><?php echo $lang['Дебар']; ?></option>
                                        <option><?php echo $lang['Делчево']; ?></option>
                                        <option ><?php echo $lang['Демир Капија']; ?></option>
                                        <option ><?php echo $lang['Демир Хисар']; ?></option>
                                        <option ><?php echo $lang['Кавадарци']; ?></option>
                                        <option ><?php echo $lang['Кичево']; ?></option>
                                        <option ><?php echo $lang['Кочани']; ?></option>
                                        <option ><?php echo $lang['Кратово']; ?></option>
                                        <option ><?php echo $lang['Крива Паланка']; ?></option>
                                        <option ><?php echo $lang['Крушево']; ?></option>
                                        <option ><?php echo $lang['Куманово']; ?></option>
                                        <option ><?php echo $lang['Македонски Брод']; ?></option>
                                        <option ><?php echo $lang['Македонска Каменица']; ?></option>
                                        <option ><?php echo $lang['Охрид']; ?></option>
                                        <option ><?php echo $lang['Пехчево']; ?></option>
                                        <option ><?php echo $lang['Прилеп']; ?></option>
                                        <option ><?php echo $lang['Пробиштип']; ?></option>
                                        <option ><?php echo $lang['Радовиш']; ?></option>
                                        <option ><?php echo $lang['Ресен']; ?></option>
                                        <option ><?php echo $lang['Свети Николе']; ?></option>
                                        <option ><?php echo $lang['Скопје']; ?></option>
                                        <option ><?php echo $lang['Струга']; ?></option>
                                        <option ><?php echo $lang['Струмица']; ?></option>
                                        <option ><?php echo $lang['Тетово']; ?></option>
                                        <option ><?php echo $lang['Штип']; ?></option>
                                    </select>
                            </tr>
                            <tr>
                                <td><?php echo $lang['address']; ?>:</td>
                                <td><input id="formular_adresa" type="text" name="adresa"/></td>
                            </tr>
                            <tr style="display: none;">
                                <td><?php echo $lang['date(bulletin)']; ?>:</td>
                                <td><input id="formular_bilten" type="text" name="datum_bilten"/></td>
                            </tr>
                            <tr>
                                <td><?php echo $lang['date']; ?>:</td>
                                <td><input id="formular_datum" type="text" name="datum"/></td>
                            </tr>
                            <tr>
                                <td colspan="2"><a class="formular_lat_lng" href="http://www.gorissen.info/Pierre/maps/googleMapLocation.php?lat=41.654308&lon=21.566162&setLatLon=Set" target="_blank"><?php echo $lang['Precise lat/lng']; ?></a></td>
                            </tr>
                            <tr>
                                <td><?php echo $lang['lat']; ?>:</td>
                                <td><input id="formular_lat" type="text" name="lat"/></td>
                            </tr>
                            <tr>
                                <td><?php echo $lang['lng']; ?>:</td>
                                <td><input id="formular_lng" type="text" name="lng"/></td>
                            </tr>
                            <tr>
                                <td><?php echo $lang['description']; ?>:</td>
                                <td><textarea id="formular_opis" rows="10" name="opis"></textarea></td>
                            </tr>
                        </table>
                    </fieldset>
                </form>
            </div>
            <?php            
            $kraj = 30 * $str;
			$pocetok = $kraj - 30;            
            $select = "SELECT * FROM nastani";
            if(isset($_GET['opis']))
                $select .= " WHERE opis LIKE '%" . mysql_real_escape_string($_GET['opis']) . "%'";
            if ($sort != NULL)
                $select .= " ORDER BY " . mysql_real_escape_string($sort) . " " . mysql_real_escape_string($nasoka);
            if ($nasoka == "ASC")
                $nasoka = "DESC";
            else
                $nasoka = "ASC";
            $select .= " LIMIT " . $pocetok . ", " . $kraj;
            $result = $konekcija->query($select);
            echo "<div class='scroll'><table id='tabela'><tbody>";
            while ($row = mysql_fetch_assoc($result))
            {
                $id = $row['nastan_id'];
                echo "<tr>";
                echo "<td><div class='id' id='" . $id . "'>" . $id . "</div></td>";
                echo "<td><div class='shto' >" . $lang[i_to_type(($row['shto']))] . "</div><div id='shto_" . $id . "' style='display: none;'>" . $row['shto'] . "</div></td>";
                echo "<td><div class='grad' id='grad_" . $id . "'>"; if($row['grad']!='') echo $lang[$row['grad']]; "</div></td>";
                echo "<td><div class='adresa' id='adresa_" . $id . "'>" . $row['adresa'] . "</div></td>";
                echo "<td><div class='datum' id='bilten_" . $id . "'>" . date($format, strtotime($row['datum_bilten'])) . "</div></td>";
                echo "<td><div class='datum' id='datum_" . $id . "'>" . date($format, strtotime($row['datum'])) . "</div></td>";
                echo "<td><div class='lat' id='lat_" . $id . "'>" . $row['lat'] . "</div></td>";
                echo "<td><div class='lng' id='lng_" . $id . "'>" . $row['lng'] . "</div></td>";
                echo "<td><textarea class='opis' rows=5 readonly='readonly' id='opis_" . $id . "'>" . $row['opis'] . "</textarea></td>";
                echo "</tr>";
            }
            echo "</tbody></table></div>";
            ?>
            <div class="kopchninja">
                <button class="prijavi"><?php echo $lang['report']; ?></button>
            </div>
            <?php
            echo "<div class='str'><div>" . $lang['Showing up to 30 items from page:'] . "<div style='height: 5px;'></div>";
            echo "<a href='?str=1";
            if ($sort)
                echo "?sort=" . $sort;            
                echo "&l=" . $l;
            echo "'> |<< </a>";
            if ($str == 1)
                echo "<a class='ne_moze'> < </a>";
            else
            {
                echo "<a href='?str=" . ($str - 1);
                if ($sort)
                    echo "&sort=" . $sort;                
                    echo "&l=" . $l;
                echo "'> < </a>";
            }
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
                    echo "<a class='tekovna' href='#'> " . $i . " </a>";
                else
                {
                    echo "<a href='?str=" . $i;
                    if ($sort)
                        echo "&sort=" . $sort;
                        echo "&l=" . $l;
                    echo "'> " . $i . " </a>";
                }
            }
            if ($str == $str_max)
                echo "<a class='ne_moze'> ></a>";
            else{
                echo "<a href='?str=" . ($str + 1);
                if ($sort)
                        echo "&sort=" . $sort;
                        echo "&l=" . $l;
                echo "' > ></a>";
            }
            echo "<a href='?str=" . $str_max;
            if ($sort)
                echo "&sort=" . $sort;
                echo "&l=" . $l;
            echo "'> >>| </a>";
            echo "</div></div>";			
            ?>
        </div>
        <div class='bottom'></div>
    </body>
</html>
