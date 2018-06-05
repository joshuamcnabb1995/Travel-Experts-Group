<?php
if ($_POST["email"]<>'') {
    $ToEmail = 'sara_n_h@yahoo.com';
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
?>
Your message was sent
<?php
} else {
?>
