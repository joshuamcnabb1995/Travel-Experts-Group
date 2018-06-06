<?php
    /*
        Author: Safiq Momin
        Date of creation: 06-01-2018
        Description: The file contains html code for registration and php code to verify different conditions of the fields relating the database

        Modified by: Joshua McNabb
        Date: 06-05-2018
        Description: Converted MySQLi to PDO
                     Added sessions with the text of the error messages
    */

    include('../inc/global.php'); // Database configuration and other checks

    $registrationForm = $_POST;

    // Loop through all the form elements and save them as variables and sessions
    foreach($_POST as $key => $value) {
        $$key = $value;
        $_SESSION[$key] = $value;
    }

    /*$username = trim($_POST['username']);
    $_SESSION['username'] = $username; // Store the username as a session so it can be put in the input if the user enters it incorrectly
    $password = $_POST['password'];
    $_SESSION['password'] = $password;
    $confirm = $_POST['confirm'];
    $_SESSION['confirm'] = $confirm;*/

    // Validate username
    if(empty(trim($_POST['username']))) {
        $_SESSION['usernameError'] = 'Please enter a username.'; // Save the error message in a session so it can be displayed on the registration page
        header('Location: index.php');
    }

    else {
        $getUser = $database->prepare("SELECT id FROM users WHERE username = ?"); // Prepare a select statement
        $getUser->execute([$username]); // Execute the prepared statement with the placeholder

        if($getUser->rowCount() == 1) {
            $_SESSION['usernameError'] = 'This username is taken.';
            header('Location: index.php');
        }
    }

    // Validating the password
    if(empty(trim($_POST['password']))) {
        $_SESSION['passwordError'] = 'Please enter a password.';
        header('Location: index.php');
    }

    else if(strlen(trim($_POST['password'])) < 6) {
        $_SESSION['passwordError'] = 'Password must have atleast 6 characters.';
        header('Location: index.php');
    }

    else
        $password = trim($_POST['password']);

    // Validate confirm password
    if(empty(trim($_POST['confirm']))) {
        $_SESSION['confirmError'] = 'Please confirm password.';
        header('Location: index.php');
    }

    else {
        $confirm_password = trim($_POST['confirm']);
        if($password != $confirm_password) {
            $_SESSION['confirmError'] = 'Password did not match.';
            header('Location: index.php');
        }
    }

    // Check input errors before inserting in database
    if(empty($_SESSION['usernameError']) && empty($_SESSION['passwordError']) && empty($_SESSION['confirmError'])) {
        // Prepare an insert statement
        $addUser = $database->query("INSERT INTO users (username, password) VALUES (?, ?)");
        $passwordOptions = [ 'cost' => 13 ]; // Make the password somewhat difficult to crack
        $addUser->execute($username, password_hash($password, PASSWORD_BCRYPT, $passwordOptions)); // Hash the password with Bcrypt so it's more secure than a plaintext password

        if($addUser->errorCode() == 0) // Check for errors
            header('location: login.php'); // Redirect to login page if the query went through successfully (replace with code to lof the user in)

        else
            echo 'Something went wrong. Please try again later.'; // Otherwise, show an error
    }
