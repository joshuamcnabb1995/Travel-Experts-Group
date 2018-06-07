<?php
    /*
        Author: Safiq Momin
        Date of creation: 06-01-2018
        Description: The file contains html code for registration and php code to verify different conditions of the fields relating the database
        Work Done: Added validation for email, username, password and confirm password fields

        Modified by: Joshua McNabb
        Date: 06-05-2018 - 06-07-2018
        Work Done: Converted MySQLi to PDO
                     Added sessions with the text of the error messages
                     Added additional validation for all form fields
    */

    include('../inc/global.php'); // Database configuration and other checks

    $registrationForm = $_POST; // Store all the elements in the form as a variable so they can be looped through
    $formErrors = 0; // By default, there's no form errors, but they can be added

    // Function to handle error creation to reduce repetition
    public function generateError($field, $errorMessage)
    {
        $_SESSION[$field . 'Error'] = $errorMessage;
        $formErrors += 1;
    }

    // Loop through all the form elements and save them as variables and sessions
    foreach($registrationForm as $key => $value) {
        $$key = $value;
        $_SESSION[$key] = trim($value); // Remove whitespace from beginning and end of the form input
    }

    // Validate Email
    if(empty($_POST['email'])) generateError('email', 'Please enter an email address.');
    else if(!preg_match('/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/', $email))
        generateError('email', 'Invalid email format.');
    else {
        $getEmail = $database->prepare("SELECT id FROM customers WHERE CustEmail = ?"); // Prepare a select statement
        $getEmail->execute([$email]); // Execute the prepared statement with the placeholder

        // Email address belongs to another customer
        if($getEmail->rowCount() == 1) generateError('email', 'Email address already in use.');
    }

    // Validate username
    if(empty($_POST['username'])) generateError('username', 'Please enter a username.');
    else if(strlen($username) < 2) generateError('username', 'Username must be between 2 and 25 characters long.');
    else if(strlen($username) > 25) generateError('username', 'Username must be between 2 and 25 characters long.');
    else {
        $getUser = $database->prepare("SELECT id FROM users WHERE username = ?");
        $getUser->execute([$username]);

        if($getUser->rowCount() == 1) generateError('username', 'This username is taken.');
    }
    // Validate username

    // Validating the password
    if(empty($_POST['password'])) {
        $_SESSION['passwordError'] = 'Please enter a password.';
        $formErrors += 1;
    }

    else if(strlen($_POST['password']) < 6) {
        $_SESSION['passwordError'] = 'Password must have atleast 6 characters.';
        $formErrors += 1;
    }

    else
        $password = $_POST['password'];

    // Validate confirm password
    if(empty($_POST['confirm'])) {
        $_SESSION['confirmError'] = 'Please confirm password.';
        $formErrors += 1;
    }

    else {
        $confirm_password = $_POST['confirm'];
        if($password != $confirm_password) {
            $_SESSION['confirmError'] = 'Passwords do not match.';
            $formErrors += 1;
        }
    }

    // Check form errors before inserting in database
    if($formErrors == 0) {
        $addUser = $database->query("INSERT INTO users (username, password) VALUES (?, ?)");
        $passwordOptions = [ 'cost' => 13 ]; // Make the password somewhat difficult to crack
        $addUser->execute($username, password_hash($password, PASSWORD_BCRYPT, $passwordOptions)); // Hash the password with Bcrypt so it's more secure than a plaintext password

        if($addUser->errorCode() == 0) // Check for errors
            header('location: login.php'); // Redirect to login page if the query went through successfully (replace with code to lof the user in)

        else
            echo 'Something went wrong. Please try again later.'; // Otherwise, show an error
    }

    else {
        $_SESSION['formErrors'] = $formErrors;
        header('Location: index.php');
    }
