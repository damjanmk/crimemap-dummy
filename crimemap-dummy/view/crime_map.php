
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <script type="text/javascript"
                src="http://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&sensor=false&libraries=visualization">
        </script>
        <script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="../js/jquery-ui-1.8.22.custom.min.js"></script>
        <script type="text/javascript" src="../js/markerclusterer.js"></script>
        <script type="text/javascript" src="../js/oms.min.js"></script>
        <script type="text/javascript" src="../js/crime_map.js"></script>
        <link rel="stylesheet" href="../css/crime_map.css" type="text/css">
        <?php
        require "../model/selector.php";

        function date_to_mysql($date)
        {
            $day = strtok($date, "./");
            if($day == '')
                return '';
            $month = strtok("./");
            $year = strtok("./");
            return $year . '/' . $month . '/' . $day;
        }

        $doma = false;
        $selector = new Selector();
        if (!isset($_GET['a']) || $_GET['a'] == '0') {
            //print_r($_POST);
            $o = null;
            $d = null;
            if (isset($_GET['doma']) && $_GET['doma'] == '1') {
                $doma = true;
                $o = date("Y-m-d", strtotime("-30 days"));
                $d = date("Y-m-d");
                $selector->where_datum($o, $d, TRUE);
            } else {
                $first = false;
                $g_first = false;
                $s_first = false;
                $d_first = false;
                $dn_first = false;
                $g = null;
                $s = null;
                $dn = null;
                if (isset($_POST['g']) && $_POST['g'] != null) {
                    $g = $_POST['g'];
                    if (!$first) {
                        $first = true;
                        $g_first = true;
                    }
                }
                if (isset($_POST['s']) && $_POST['s'] != null) {
                    $s = $_POST['s'];
                    if (!$first) {
                        $first = true;
                        $s_first = true;
                    }
                }
                if ((isset($_POST['o']) && $_POST['o'] != null) || (isset($_POST['d']) && $_POST['d'] != null )) {
                    $o = date_to_mysql($_POST['o']);
                    $d = date_to_mysql($_POST['d']);
                    if (!$first) {
                        $first = true;
                        $d_first = true;
                    }
                }
                if (isset($_POST['dn']) && $_POST['dn'] != null) {
                    $dn = $_POST['dn'];
                    if (!$first) {
                        $first = true;
                        $dn_first = true;
                    }
                }
                if ($g != null) {
                    $selector->where_grad($g, $g_first);
                }
                if ($s != null) {
                    $selector->where_shto($s, $s_first);
                }
                if ($o != null || $d != null) {
                    $selector->where_datum($o, $d, $d_first);
                }
                if ($dn != null) {
                    $selector->where_den($dn, $dn_first);
                }
            }
        }
        $marker = false; 
        $sql = $selector->get_query();
        //echo $sql; die();
        echo "<script type='text/javascript'>";
        echo "$(function(){ $.get('../model/run_select.php', { sql : \"" . $sql . "\"}, function(data){";
        if(isset($_GET['map']) && $_GET['map'] == "heat"){
            echo "$('#count').html(heat_map(data));";
        }
        else {
            $marker = true;
            echo "var markers = marker_map(data);
            var c = markers.length; 
            $('#count').html(c);
            var i;  
            function random_event(){               
            	i = Math.floor((Math.random()*c)+1);                 
            	$('#event_opis').text(markers[i].opis);
			}
			random_event();
			$('#event_opis').click(function(){            		
    				google.maps.event.trigger(markers[i], 'click');
			});
			
			$('#new_random').click(function(){
				for(j = 0; j < c; j++){
					if(markers[j].infowindow != null)
						markers[j].infowindow.close();
        		}
    			random_event();
    		});
            ";
        }
        echo "}); }); ";
        echo "</script>";
        ?>
    </head>
    <body>
        <?php require 'header.php' ?>
        <title><?php echo $lang['Crime Map Macedonia'];?></title>
        <?php require '../functions/view.php' ?>
        <div class="clear"></div>
        <div id="feedback">
            <span class="feedback"><?php echo $lang['Showing']; if(isset($_GET['a']) && $_GET['a'] == '1') echo ' ' . mb_strtolower(($lang['All']), 'UTF-8'); ?> </span><strong><span class="feedback" id="count"></span></strong><span class="feedback"> <?php echo $lang['events']; ?>
            <?php            
            if($doma){
                echo $lang['for the last 30 days'];
            }
            else if (!empty($_POST))
            {
                if ($_POST['o'] != null || $_POST['d'] != null || $_POST['g'] != null || $_POST['s'] != null || $_POST['dn'] != null)
                {
                    echo " " . $lang['where'] . " ";
                    if (isset($_POST['g']) && $_POST['g'] != null)
                    {
                        echo $lang['the city is'] . " <strong>" . $_POST['g'] . "</strong> ";
                    }
                    if (isset($_POST['s']) && $_POST['s'] != null)
                    {
                        echo $lang['the type of crime is'] . " <strong>" . $lang[i_to_type($_POST['s'])] . "</strong> ";
                    }
                    if (isset($_POST['dn']) && $_POST['dn'] != null)
                    {
                        echo $lang['the day of week is'] . " <strong>" . $lang[i_to_day($_POST['dn'])] . "</strong> ";
                    }
                    if ((isset($_POST['o']) && $_POST['o'] != null) || (isset($_POST['d']) && $_POST['d'] != null))
                    {
                        if((isset($_POST['o']) && $_POST['o'] != null)){
                            echo $lang['the date is between'] . " <strong>" . $_POST['o'] . "</strong> " . $lang['and'] . " ";
                            if((isset($_POST['d']) && $_POST['d'] != null)){
                                echo "<strong>" . $_POST['d'] . "</strong>";
                            }
                            else{
                                echo "<strong>";
                                if ($_GET['l'] == 'en')
                                    echo date("d/m/Y") . "</strong>";
                                else
                                    echo date("d.m.Y") . "</strong>";
                            }
                        }
                        else{
                            echo $lang['the date is between'] . " <strong>";
                            if ($_GET['l'] == 'en')
                                echo "21/06/2012";
                            else
                                echo "21.06.2012";
                            echo "</strong> " . $lang['and'] . " <strong>" . $_POST['d'] . "</strong>";
                        }                        
                    }
                }
            }
            ?>
                </span>
        </div>
        <div class="clear"></div>
        <div id="marker_div">
            <form action='#' method='POST'>
                <?php
                if($doma==false){
                foreach ($_POST as $a => $b)
                {
                    echo "<input type='hidden' name='" . $a . "' value='" . $b . "'>";
                }
                }
                $c = null;
                if(isset($_POST['center']))
                	$c = $_POST['center'];
                if($c == null){
                	$c = "(41.666, 21.644)";
                }
                $z = null;
                if(isset($_POST['zoom']))
                	$z = $_POST['zoom'];
                if($z == null){
                	$z = "9";
                }
                ?>
                <input type='hidden' name='center' id='center' value='<?php echo $c;?>' />
                <input type='hidden' name='zoom' id='zoom' value='<?php echo $z;?>'/>
            </form>
        <?php
        if($marker){
           if(isset($_GET['a']) && $_GET['a'] == '1')
            {
                echo "<div class='marker' id='?a=1&map=heat";
                if(isset($_GET['l']))
                    echo "&l=" . $_GET['l'];
                if(isset($_GET['doma']))
                    echo "&doma=" . $_GET['doma'];
                echo "'";
                echo ">" . $lang['Heat Map'] . "</div>";
            }
           else{
               echo "<div class='marker' id='?a=0&map=heat";
               if(isset($_GET['l'])) 
                    echo "&l=" . $_GET['l'];
               if(isset($_GET['doma']))
                    echo "&doma=" . $_GET['doma'];
               echo "'";
               echo ">" . $lang['Heat Map'] . "</div>";
           }
        }else{
           if(isset($_GET['a']) && $_GET['a'] == '1'){
               echo "<div class='marker' id='?a=1&map=marker";
               if(isset($_GET['l']))
                    echo "&l=" . $_GET['l'];
               if(isset($_GET['doma']))
                    echo "&doma=" . $_GET['doma'];
               echo "'";
               echo ">" . $lang['Marker Map'] . "</div>";
           }
           else{
               echo "<div class='marker' id='?a=0&map=marker";
               if(isset($_GET['l'])) 
                    echo "&l=" . $_GET['l'];
               if(isset($_GET['doma']))
                    echo "&doma=" . $_GET['doma'];
               echo "'";
               echo ">" . $lang['Marker Map'] . "</div>";
           }
        }
        ?>
        </div>
        <div class="top" id="map_top"></div>
        <div class="middle" id="map">
            <div id="map_canvas" ></div>        
        <?php 
        if($marker){        	
        	?>
        	<div id="znaci_opis">
        	<div class="znak"><img class="znak_img" alt="znak" src="../img/marker/pistol.png"> <div class="znak_opis"><?php echo $lang['weapons'];?></div></div>
        	<div class="znak"><img class="znak_img" alt="znak" src="../img/marker/boks.png"> <div class="znak_opis"><?php echo $lang['violence'];?></div></div>
        	<div class="znak"><img class="znak_img" alt="znak" src="../img/marker/kradec.png"> <div class="znak_opis"><?php echo $lang['theft'];?></div></div>
        	<div class="znak"><img class="znak_img" alt="znak" src="../img/marker/dokumenti.png"> <div class="znak_opis"><?php echo $lang['documents'];?></div></div>
        	<div class="znak"><img class="znak_img" alt="znak" src="../img/marker/droga.png"> <div class="znak_opis"><?php echo $lang['drugs'];?></div></div>
        	<div class="znak"><img class="znak_img" alt="znak" src="../img/marker/kola.png"> <div class="znak_opis"><?php echo $lang['traffic'];?></div></div>
        	<div class="znak"><img class="znak_img" alt="znak" src="../img/marker/drugo.png"> <div class="znak_opis"><?php echo $lang['other'];?></div></div>
        	</div>
        	<?php 
        }
	        ?>
		</div>
		<div class="bottom" id="map_bottom"></div>
		<?php 
        if($marker){        	
        	?>
		<div class="top" id="event_top"></div>
		<div class="middle" id="event">
			<div id="event_text">
				<div id="event_levo">
					<?php echo $lang['random'];?>
				</div>
				<a id="event_opis"></a>			
			</div>
		</div>
		<div class="bottom"
			id="event_bottom"></div>
		<?php 
        }
	        ?>
	        
		<div class="top" id="info_top"></div>
		<div class="middle" id="info">
			<div id="info_text">
				<?php echo $lang['info'];?>
			</div>
		</div>
		<div class="bottom"
			id="info_bottom"></div>
		<?php require 'footer.php' ?>
</body>
</html>

