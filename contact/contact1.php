<?php

if(isset($_POST['submit']))
{

$message=
'First Name:	'.$_POST['fname'].'<br />
Last Name:	'.$_POST['lastname'].'<br />
Phone:	'.$_POST['phone'].'<br />
Email:	'.$_POST['email'].'<br />
Message:	'.$_POST['message'].'
';
    require "phpmailer/class.phpmailer.php"; //include phpmailer class

    // Instantiate Class
    $mail = new PHPMailer();

    // Set up SMTP
    $mail->IsSMTP();                // Sets up a SMTP connection
    $mail->SMTPAuth = true;         // Connection with the SMTP does require authorization
    $mail->SMTPSecure = "ssl";      // Connect using a TLS connection
    $mail->Host = "smtp.gmail.com";  //Gmail SMTP server address
    $mail->Port = 465;  //Gmail SMTP port
    $mail->Encoding = '7bit';

    // Authentication
    $mail->Username   = "sara.sara.nh@gmail.com"; // full Gmail address
    $mail->Password   = "B1234567890"; //  Gmail password

    // Compose
    $mail->SetFrom($_POST['email'], $_POST['fname'], $_POST['surname']);
    $mail->AddReplyTo($_POST['email'], $_POST['fname'], $_POST['surname']);
    $mail->Subject = "New Contact Form Message";      // Subject
    $mail->MsgHTML($message);

    // Send To
    $mail->AddAddress("recipientemail@gmail.com", "TravelExpert"); // Where to send it - Recipient
    $result = $mail->Send();		// Send!
	$message = $result ? 'Successfully Sent!' : 'Sending Failed!';
	unset($mail);

}
?>
