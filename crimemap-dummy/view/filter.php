<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="../js/jquery-ui-1.8.22.custom.min.js"></script>
        <?php
        if (isset($_GET['l']) && $_GET['l'] != null)
        {
            if ($_GET['l'] == 'mk')
                echo "<script type='text/javascript' src='../js/jquery.ui.datepicker-mk.js'></script>";
            else if ($_GET['l'] == 'en')
                echo "<script type='text/javascript' src='../js/jquery.ui.datepicker-en.js'></script>";
            else if ($_GET['l'] == 'sq')
                echo "<script type='text/javascript' src='../js/jquery.ui.datepicker-sq.js'></script>";
        }
        else
            echo "<script type='text/javascript' src='../js/jquery.ui.datepicker-mk.js'></script>";
        ?>
        <link rel="stylesheet" href="../css/custom-theme/jquery-ui-1.8.22.custom.css" type="text/css">
        <link rel="stylesheet" href="../css/filter.css" type="text/css">
        <script type="text/javascript" src="../js/filter.js"></script>
    </head>
    <body>
<?php require_once 'header.php'; ?>
	<title><?php echo $lang['Crime Map Macedonia'];?></title>
        <div class="clear"></div>
        <div id="container">
            <form method="POST" action="./crime_map.php?l=<?php echo $_GET['l']; if(isset($_GET['map'])) echo "&map=" . $_GET['map']; if(isset($_GET['str'])) echo "&str=" . $_GET['str']; if(isset($_GET['sort'])) echo "&sort=" . $_GET['sort']; ?>">
                <input type="hidden" name="o" id="odHdn"/>
                <input type="hidden" name="d" id="doHdn"/>
                <input type="hidden" name="g" id="gradHdn"/>
                <input type="hidden" name="s" id="shtoHdn"/>
                <input type="hidden" name="dn" id="denHdn"/>
                <div class="top" id="gradovi_top"></div>
                <div class="middle" id="gradovi">                    
                    <div class="gradovi" id="Берово"><?php echo $lang['Берово']; ?></div>
                    <div class="gradovi" id="Битола"><?php echo $lang['Битола']; ?></div>
                    <div class="gradovi" id="Богданци"><?php echo $lang['Богданци']; ?></div>
                    <div class="gradovi" id="Валандово"><?php echo $lang['Валандово']; ?></div>
                    <div class="gradovi" id="Велес"><?php echo $lang['Велес']; ?></div>
                    <div class="gradovi" id="Виница"><?php echo $lang['Виница']; ?></div>
                    <div class="gradovi" id="Гевгелија"><?php echo $lang['Гевгелија']; ?></div>
                    <div class="gradovi" id="Гостивар"><?php echo $lang['Гостивар']; ?></div>
                    <div class="gradovi" id="Дебар"><?php echo $lang['Дебар']; ?></div>
                    <div class="gradovi" id="Делчево"><?php echo $lang['Делчево']; ?></div>
                    <div class="gradovi" id="Демир_Капија"><?php echo $lang['Демир Капија']; ?></div>
                    <div class="gradovi" id="Демир_Хисар"><?php echo $lang['Демир Хисар']; ?></div>
                    <div class="gradovi" id="Кавадарци"><?php echo $lang['Кавадарци']; ?></div>
                    <div class="gradovi" id="Кичево"><?php echo $lang['Кичево']; ?></div>
                    <div class="gradovi" id="Кочани"><?php echo $lang['Кочани']; ?></div>
                    <div class="gradovi" id="Кратово"><?php echo $lang['Кратово']; ?></div>
                    <div class="gradovi" id="Крива_Паланка"><?php echo $lang['Крива Паланка']; ?></div>
                    <div class="gradovi" id="Крушево"><?php echo $lang['Крушево']; ?></div>
                    <div class="gradovi" id="Куманово"><?php echo $lang['Куманово']; ?></div>
                    <div class="gradovi" id="Македонски_Брод"><?php echo $lang['Македонски Брод']; ?></div>
                    <div class="gradovi" id="Македонска_Каменица"><?php echo $lang['Македонска Каменица']; ?></div>
                    <div class="gradovi" id="Охрид"><?php echo $lang['Охрид']; ?></div>
                    <div class="gradovi" id="Пехчево"><?php echo $lang['Пехчево']; ?></div>
                    <div class="gradovi" id="Прилеп"><?php echo $lang['Прилеп']; ?></div>
                    <div class="gradovi" id="Пробиштип"><?php echo $lang['Пробиштип']; ?></div>
                    <div class="gradovi" id="Радовиш"><?php echo $lang['Радовиш']; ?></div>
                    <div class="gradovi" id="Ресен"><?php echo $lang['Ресен']; ?></div>
                    <div class="gradovi" id="Свети_Николе"><?php echo $lang['Свети Николе']; ?></div>
                    <div class="gradovi" id="Скопје"><?php echo $lang['Скопје']; ?></div>
                    <div class="gradovi" id="Струга"><?php echo $lang['Струга']; ?></div>
                    <div class="gradovi" id="Струмица"><?php echo $lang['Струмица']; ?></div>
                    <div class="gradovi" id="Тетово"><?php echo $lang['Тетово']; ?></div>
                    <div class="gradovi" id="Штип"><?php echo $lang['Штип']; ?></div>
                </div>
                <div class="bottom" id="gradovi_bottom"></div>
                <div class="clear"></div>
                <div class="top" id="shto_top"></div>
                <div class="middle" id="shto">
                    <div class="shto" id="0"><?php echo $lang['weapons']; ?></div>
                    <div class="shto" id="1"><?php echo $lang['violence']; ?></div>
                    <div class="shto" id="2"><?php echo $lang['theft']; ?></div>
                    <div class="shto" id="3"><?php echo $lang['documents']; ?></div>
                    <div class="shto" id="4"><?php echo $lang['drugs']; ?></div>
                    <div class="shto" id="5"><?php echo $lang['traffic']; ?></div>
                    <div class="shto" id="6"><?php echo $lang['other']; ?></div>
                </div>
                <div class="bottom" id="shto_bottom"></div>
                <div class="clear"></div>
                <div class="top" id="datumi_top"></div>
                <div class="middle" id="denovi">
                    <div class="denovi" id="d2"><?php echo $lang['Monday']; ?></div>
                    <div class="denovi" id="d3"><?php echo $lang['Tuesday']; ?></div>
                    <div class="denovi" id="d4"><?php echo $lang['Wednesday']; ?></div>
                    <div class="denovi" id="d5"><?php echo $lang['Thursday']; ?></div>
                    <div class="denovi" id="d6"><?php echo $lang['Friday']; ?></div>
                    <div class="denovi" id="d7"><?php echo $lang['Saturday']; ?></div>
                    <div class="denovi" id="d1"><?php echo $lang['Sunday']; ?></div>
                </div>
                <div class="bottom" id="datumi_bottom"></div>
                <div class="clear"></div>
                <div class="top" id="datumi_top"></div>
                <div class="middle" id="datumi">
                    <div id="a" style="margin: 0px auto; width: 66%;">
                        <div class="datum">
                            <div class="datum_title"><?php echo $lang['from']; ?></div>
                            <div class="clear"></div>
                            <div id="od"></div>
                        </div>
                        <div class="datum">
                            <div class="datum_title"><?php echo $lang['to']; ?></div>
                            <div class="clear"></div>
                            <div id="do"></div>
                        </div>
                    </div>
                </div>
                <div class="bottom" id="datumi_bottom"></div>
                <div id="filter_div">
                <input id="submit" type="submit" class="filter" value="<?php echo $lang['Filter']; ?>"/>
                </div>
            </form>
        </div>
    </body>
</html>