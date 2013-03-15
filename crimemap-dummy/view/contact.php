<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link rel="stylesheet" href="../css/contact.css" type="text/css">
</head>
<body>
	<?php 	require_once 'header.php';?>
	<title><?php echo $lang['Crime Map Macedonia'];?></title>
	<div class="top"></div>
	<div class="middle">
		<div class="info">
			<?php echo $lang['leave_comment'];?>
		</div>
		<div class="text">
			<?php 
			$action = "../model/swiftmailer.php";
			if(isset($_GET['l'])) $action .= "?l=" . $_GET['l'];
			if(isset($_GET['a'])) $action .= "&a=" . $_GET['a'];

			$message = "";
			if(isset($_GET['e'])) {
				switch ($_GET['e']){
					case "success": {
						$message = $lang['success_m']; break;
					}
					case "captcha": {
						$message = $lang['captcha_m'];						
						break;
					}
					case "delivery": {
						$message = $lang['delivery_m']; break;
					}
					case "email": {
						$message = $lang['email_m']; break;
					}
					case "incomplete": {
						$message = $lang['incomplete_m'];
						$message .= $_GET['fields'];
						break;
					}
				}
			}
			echo "<div class='error'>" . $message . "</div>";
			?>
			<form action="<?php echo $action; ?>" method="post">
				<div class="row">
					<div class="label">
						<?php echo $lang['name'];?>
						:
					</div>
					<div class="field">
						<input type="text" name="n" />
					</div>
				</div>

				<div class="row">
					<div class="label">email *:</div>
					<div class="field">
						<input type="text" name="f" />
					</div>
				</div>

				<div class="row">
					<div class="label">
						<?php echo $lang['message'];?>
						*:
					</div>
					<div class="field">
						<div class="field">
							<textarea name="b"></textarea>
						</div>
					</div>
				</div>
				<div class="row">
					<img id="captcha" src="../securimage/securimage_show.php" alt="CAPTCHA Image" />					
					<a href="#" onclick="document.getElementById('captcha').src = '../securimage/securimage_show.php?sid=' + Math.random(); return false">
						<img src="http://www.phpcaptcha.org/securimage3/new/images/refresh.png" height="32" width="32" alt="Reload Image" onclick="this.blur()" align="bottom" border="0"/></a>					
				</div>
				<div class="row">
					<div class="label">
						<?php echo $lang['enter_captcha'];?>
						*:
					</div>
					<input type="text" name="captcha_code" size="10" maxlength="6" />
				</div>
				<div class="row">
					<div class="label">&nbsp;</div>
					<div class="field">
						<input class="send" type="submit" name="submit"
							value="<?php echo $lang['send']; ?>" />
					</div>
				</div>
			</form>

		</div>
	</div>
	<div class="bottom"></div>
</body>
</html>

