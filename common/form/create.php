<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function

if(!$_POST)
	die("You do not have permission to access this file");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include('../../config.php');
//Load Composer's autoloader
require '../../vendor/autoload.php';

function sendMail(){
	global $config;
	$name = $_POST['name'];
	$visitor_email = $_POST['email'];
	$phone = $_POST['phone'];
	$message = $_POST['comments'];

  	$email_from = 'yourname@yourwebsite.com';

	$email_subject = "mail Subject";

	$email_body = ""; //your email body


	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 587;
	$mail->SMTPSecure = 'tls';
	$mail->SMTPAuth = true;
	$mail->Username = ''; // add username
	$mail->Password = ''; // add password
	$mail->setFrom($config['mail_form'], $config['brand_name'].' Website');
	$mail->addAddress($config['sendto_mail']);
	$mail->addReplyTo($visitor_email, $name);
	$mail->Subject = $email_subject;
	$mail->msgHTML($email_body);
	if (!$mail->send()) {
	$error = "Mailer Error: " . $mail->ErrorInfo;
	echo '<p id="para">'.$error.'</p>';
	}
	else {
	 echo $visitor_email.'<p id="para">Message sent!</p>'.$config['brand_name'];
	}
}

sendMail();


?>