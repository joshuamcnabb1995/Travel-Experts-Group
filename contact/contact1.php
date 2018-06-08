<?php

//if(isset($_POST['submit']))
//{

$message=
'First Name:	'.$_POST['fname'].'<br />
Last Name:	'.$_POST['surname'].'<br />
Phone:	'.$_POST['phone'].'<br />
Email:	'.$_POST['email'].'<br />
Message:	'.$_POST['message'].'
';

    require "../inc/plugins/class.smtp.php";
    require "../inc/plugins/class.phpmailer.php"; //include phpmailer class

    // Instantiate Class
    /*$mail = new PHPMailer();

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
    $mail->AddAddress("rozaroza.nh@gmail.com", "TravelExpert"); // Where to send it - Recipient
    $result = $mail->Send();		// Send!
	  $message = $result ? 'Successfully Sent!' : 'Sending Failed*/

    $mail = new PHPMailer();

    $mail->IsSMTP();
    $mail->CharSet="UTF-8";
    $mail->SMTPSecure = 'tls';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->Username = 'sara.sara.nh@gmail.com';
    $mail->Password = 'B1234567890';
    $mail->SMTPAuth = true;

    // From
    $mail->From = 'sara.sara.nh@gmail.com';

    // To
    $mail->AddAddress($_POST['email']);

    $mail->IsHTML(true);
    $mail->Subject    = "New Contact Form Message";
    $mail->Body    = $message;
    if ($mail->send()) {
    //all ok
} else {
  echo  $error_message = $mail->ErrorInfo;
}

    //if(!empty($mail->errorInfo())) echo $mail->errorInfo();
	//unset($mail);

//}
?>
