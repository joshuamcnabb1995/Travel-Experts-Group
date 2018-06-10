
<!-- Student Name: S-Sara Nejad-Hashemi -->

 <?php
      $from = '<demo@domain.com>';
      $sendTo = '<sara_n_h@yahoo.com>';
      $subject = 'New message from contact form';
      $fields = array('fname' => 'FirstName', 'surname' => 'Surname', 'phone' => 'Phone', 'email' => 'Email', 'message' => 'Message');
      $okMessage = 'Your message successfully submitted. Thank you, we will get back to you soon!';
      $errorMessage = 'There was an error while submitting the form. Please try again later';

      // turn this off by error_reporting(0) after debugging;
        error_reporting(E_ALL & ~E_NOTICE);
      //-------------
      try
      {
        if(count($_POST) == 0) echo'Form is empty';

        $emailText = "You have a new message from your contact form\n=============================\n";

        foreach ($_POST as $key => $value) {

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
    // -----
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
