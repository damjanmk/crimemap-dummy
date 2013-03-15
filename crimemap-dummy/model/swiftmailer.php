
<?php  
session_start(); 
$qs = "";
if(isset($_GET['l'])) $qs .= "&l=" . $_GET['l'];
if(isset($_GET['a'])) $qs .= "&a=" . $_GET['a'];
require_once '../lib/swift_required.php';
require_once '../securimage/securimage.php';

$securimage = new Securimage();
if ($securimage->check($_POST['captcha_code']) == false) {
	header("Location: ../view/contact.php?e=captcha" . $qs);
	exit();
}


//Create an empty array where we can catch any fields which were not filled in

$fields_not_set = array();

//Check if all POST data was sent, redirect with an e if not
if (empty($_POST["f"])) $fields_not_set[] = "email";
if (empty($_POST["b"])) $fields_not_set[] = "message";
if (empty($_POST["captcha_code"])) $fields_not_set[] = "captcha";

//If $fields_not_set contains any values, then something wasn't filled in. Time to redirect.

if (!empty($fields_not_set))
{
	//Read further down to see how we'll modify form.php to handle the e
	header("Location: ../view/contact.php?e=incomplete&fields=" . implode(",", $fields_not_set) . $qs);
	exit();
}

if (!filter_var($_POST['f'], FILTER_VALIDATE_EMAIL))
{
	header("Location: ../view/contact.php?e=email" . $qs);
	exit();
}
$from = filter_var($_POST['f'], FILTER_SANITIZE_EMAIL);
$name = trim($_POST['n']);
$body = trim($_POST['b']);

$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
->setUsername('crimemapmacedonia@gmail.com')
->setPassword('finkicrime2012');

$mailer = Swift_Mailer::newInstance($transport);

$message = Swift_Message::newInstance('Crimemap Contact')
->setTo(array('crimemapmacedonia@gmail.com'))
->setFrom('crimemapmacedonia@gmail.com')
->setBody(
		"Примена е нова порака од: " . $name . ", \nсо е-адреса: " . $from . ", \nкоја гласи: \n" . $body
		);

$result = $mailer->send($message);
if ($result)
{
	//Read further down to see how we'll modify form.php to handle the e
	header("Location: ../view/contact.php?e=success" . $qs);
	exit();
}
else
{
	header("Location: ../view/contact.php?e=delivery" . $qs);
	exit();
}
?>
