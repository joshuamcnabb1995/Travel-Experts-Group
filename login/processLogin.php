<?php
    /*
      Author: Safiq Momin
      Date of creation: 06-01-2018
      Description: The file contains php code to verify different conditions of username and password field in relation with the database

      Modified By: Joshua McNabb
      Date: 06-08-2018 - 06-10-2018
      Work done: Converted variables to sessions to be able to carry the error messages over to the main page
                 Added generateError function to reduce code repetition
                 Looped through the $_POST array and set variables
    */

    include('../inc/global.php');

    // Define variables and initialize with empty values
    $loginForm = $_POST; // Store all the elements in the form as a variable so they can be looped through
    $formErrors = 0; // By default, there's no form errors, but they can be added

    function generateError($field, $errorMessage)
    {
        $_SESSION[$field . 'Error_login'] = $errorMessage; // Store the error message as a session so it can be viewed on the registration page
        global $formErrors; // Declare the variable as global so it can be accessed outside the function
        $formErrors += 1; // Add a new error everytime the function runs
    }

    foreach($loginForm as $key => $value) {
        $$key = $value; // Store each form value as a variable based on the key in the POST array ($username, $email, etc.)
        $_SESSION['login_' . $key] = trim($value); // Remove whitespace from beginning and end of each form value and store it as a session so the user doesn't have to enter their information again
    }

    // Validate Email
    if(empty($email)) generateError('email', 'Please enter an email address.');
    else if(!preg_match('/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/', $email))
        generateError('email', 'Invalid email format.');
    else {
        $getEmail = $database->prepare("SELECT CustomerId FROM customers WHERE CustEmail = ?"); // Prepare a select statement
        $getEmail->execute([$email]); // Execute the prepared statement with the placeholder

        if($getEmail->rowCount() == 0) generateError('email', 'Email doesn\'t exist.');
    }
    // Validate email

    // Validate password
    if(empty($password)) generateError('password', 'Please enter a password.');
    else {
        $getPassword = $database->prepare("SELECT CustPassword FROM customers WHERE CustEmail = ? ORDER BY CustomerId DESC LIMIT 1");
        $getPassword->execute([$email]);
        $databasePassword = $getPassword->fetch();

        // Joshua
        if(!password_verify($password, $databasePassword['CustPassword'])) generateError('password', 'The password doesn\'t match the one on your account.');
    }
    // Validate password

    if($formErrors == 0) {
        $getUID = $database->prepare("SELECT CustUID FROM customers WHERE CustEmail = ? AND CustPassword = ?"); // Prepare a select statement
        $getUID->execute([$email, $databasePassword['CustPassword']]); // Execute the prepared statement with the placeholder
        $UID = $getUID->fetch();

        echo $UID['CustUID'];
        setcookie('uid', $UID['CustUID'], strtotime('+1 year'), '/', 'localhost', false, true); // Log the user in
        header('Location: ../');
    }

    else
        header('Location: index.php');
