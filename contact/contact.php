 <?php
/* if ($_POST['email'] != '') {
    $EmailSubject = 'Site contact form';
    $mailheader = "From: ".$_POST["email"]."\r\n";
    $mailheader .= "Reply-To: ".$_POST["email"]."\r\n";
    $mailheader .= "Content-type: text/html; charset=iso-8859-1\r\n";
    $MESSAGE_BODY = "Name: ".$_POST["fname"]."";
    $MESSAGE_BODY = "Name: ".$_POST["surname"]."";
    $MESSAGE_BODY = "Name: ".$_POST["phone"]."";
    $MESSAGE_BODY .= "Email: ".$_POST["email"]."";
    $MESSAGE_BODY .= "Comment: ".nl2br($_POST["message"])."";
    mail($ToEmail, $EmailSubject, $MESSAGE_BODY, $mailheader) or die ("Failure");

    echo "Your message was sent";
  } else {
} */
?>
<?php

// an email address that will be in the From field of the email.
$from = 'Demo contact form <demo@domain.com>';
$sendTo = '<sara_n_h@yahoo.com>';
$subject = 'New message from contact form';
$fields = array('fname' => 'FirstName', 'surname' => 'Surname', 'phone' => 'Phone', 'email' => 'Email', 'message' => 'Message');
$okMessage = 'Contact form successfully submitted. Thank you, I will get back to you soon!';
$errorMessage = 'There was an error while submitting the form. Please try again later';

// turn this off by error_reporting(0) after debugging;
error_reporting(E_ALL & ~E_NOTICE);
//-------------
try
{

    if(count($_POST) == 0) throw new \Exception('Form is empty');

    $emailText = "You have a new message from your contact form\n=============================\n";

    foreach ($_POST as $key => $value) {
        // If the field exists in the $fields array, include it in the email
        if (isset($fields[$key])) {
            $emailText .= "$fields[$key]: $value\n";
        }
    }

    $headers = array('Content-Type: text/plain; charset="UTF-8";',
        'From: ' . $from,
        'Reply-To: ' . $from,
        'Return-Path: ' . $from,
    );

    // Send email
    mail($sendTo, $subject, $emailText, implode("\n", $headers));

    $responseArray = array('type' => 'success', 'message' => $okMessage);
}
catch (\Exception $e)
{
    $responseArray = array('type' => 'danger', 'message' => $errorMessage);
}


// if requested by AJAX request return JSON response
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $encoded = json_encode($responseArray);

    header('Content-Type: application/json');

    echo $encoded;
}
// else just display the message
else {
    echo $responseArray['message'];
}
?>
