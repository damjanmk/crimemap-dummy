<meta property="og:title" content="Crime Map Macedonia" />
<meta property="og:type" content="cause" />
<meta property="og:url" content="http://www.facebook.com/CrimeMapMacedonia" />
<meta property="og:image" content="http://sphotos-b.ak.fbcdn.net/hphotos-ak-ash4/389494_418340018219724_87343145_n.png" />
<meta property="og:site_name" content="Crime Map Macedonia" />
<meta property="fb:admins" content="726043729" />
<link rel="stylesheet" href="../css/header.css" type="text/css">
<script type="text/javascript" src="../js/header.js"></script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php
if (isset($_GET['l']) && $_GET['l'] != null)
{
    if ($_GET['l'] == 'mk')
        require '../language/mk.php';
    else if ($_GET['l'] == 'en')
        require '../language/en.php';
    else if ($_GET['l'] == 'sq')
        require '../language/sq.php';
}
else
    require '../language/mk.php';
?>
<div id="title_div">
    <span><?php echo $lang['Crime Map Macedonia']; ?></span>	
    <a href="#" id="open_data_logo"><img alt="Open Data Logo" src="../img/open_data.png"></a>	
	<div class="fb-like" data-href="http://www.facebook.com/CrimeMapMacedonia" data-send="false" data-width="300" data-show-faces="false"></div>
</div>
<div class="clear"></div>
<div >
    <a class="menu" href="crime_map.php?a=0&doma=1<?php if(isset($_GET['map'])) echo "&map=" . $_GET['map']; if(isset($_GET['l'])) echo "&l=" . $_GET['l']; ?>" id="home"><?php echo $lang['Home']; ?></a>
    <span class="menu">|</span>
    <a class="menu" href="crime_map.php?a=1<?php if(isset($_GET['map'])) echo "&map=" . $_GET['map']; if(isset($_GET['l'])) echo "&l=" . $_GET['l']; ?>" id="all"><?php echo $lang['All']; ?></a>
    <span class="menu">|</span>
    <a class="menu" href="filter.php?a=0<?php if(isset($_GET['map'])) echo "&map=" . $_GET['map']; if(isset($_GET['l'])) echo "&l=" . $_GET['l']; ?>" id="filter"><?php echo $lang['Filter']; ?></a>
    <span class="menu">|</span>
    <a class="menu" href="data.php?a=0<?php if(isset($_GET['map'])) echo "&map=" . $_GET['map']; if(isset($_GET['l'])) echo "&l=" . $_GET['l']; ?>" id="data"><?php echo $lang['Data']; ?></a>
    <span class="menu">|</span>
    <a class="menu" href="contact.php?a=0<?php if(isset($_GET['map'])) echo "&map=" . $_GET['map']; if(isset($_GET['l'])) echo "&l=" . $_GET['l']; ?>" id="contact"><?php echo $lang['Contact']; ?></a>
    <span class="menu">|</span>
    <a class="menu" href="about.php?a=0<?php if(isset($_GET['map'])) echo "&map=" . $_GET['map']; if(isset($_GET['l'])) echo "&l=" . $_GET['l']; ?>" id="about"><?php echo $lang['About']; ?></a>

    <a class="menu lang" href="?l=sq<?php if(isset($_GET['doma'])) echo "&doma=" . $_GET['doma']; if(isset($_GET['map'])) echo "&map=" . $_GET['map']; if(isset($_GET['a'])) echo "&a=" . $_GET['a']; if(isset($_GET['str'])) echo "&str=" . $_GET['str']; if(isset($_GET['sort'])) echo "&sort=" . $_GET['sort']; if(isset($_GET['opis'])) echo "&opis=" . $_GET['opis']; ?>" id="about">sq</a>
    <a class="menu lang" href="?l=en<?php if(isset($_GET['doma'])) echo "&doma=" . $_GET['doma']; if(isset($_GET['map'])) echo "&map=" . $_GET['map']; if(isset($_GET['a'])) echo "&a=" . $_GET['a']; if(isset($_GET['str'])) echo "&str=" . $_GET['str']; if(isset($_GET['sort'])) echo "&sort=" . $_GET['sort']; if(isset($_GET['opis'])) echo "&opis=" . $_GET['opis']; ?>" id="about">en</a>
    <a class="menu lang" href="?l=mk<?php if(isset($_GET['doma'])) echo "&doma=" . $_GET['doma']; if(isset($_GET['map'])) echo "&map=" . $_GET['map']; if(isset($_GET['a'])) echo "&a=" . $_GET['a']; if(isset($_GET['str'])) echo "&str=" . $_GET['str']; if(isset($_GET['sort'])) echo "&sort=" . $_GET['sort']; if(isset($_GET['opis'])) echo "&opis=" . $_GET['opis']; ?>" id="about">mk</a>
</div>
