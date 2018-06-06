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

$username = $_POST['username'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];

// Validate username
if(empty(trim($_POST['username'])))
    $_SESSION['usernameError'] = 'Please enter a username.';

else {
    $getUser = $database->prepare("SELECT id FROM users WHERE username = ?"); // Prepare a select statement
    $getUser->execute([$username]); // Execute the prepared statement with the placeholder

    if($getUser->rowCount() == 1)
        $_SESSION['usernameError'] = 'This username is taken.';
}

// Validating the password
if(empty(trim($_POST['password'])))
    $_SESSION['passwordError'] = 'Please enter a password.';

else if(strlen(trim($_POST['password'])) < 6)
    $_SESSION['passwordError'] = 'Password must have atleast 6 characters.';

else
    $password = trim($_POST['password']);

// Validate confirm password
if(empty(trim($_POST['confirm_password']))) {
    $_SESSION['confirmError'] = 'Please confirm password.';

else {
    $confirm_password = trim($_POST['confirm_password']);
    if($password != $confirm_password)
        $_SESSION['confirmError'] = 'Password did not match.';
}

// Check input errors before inserting in database
if(empty($_SESSION['usernameError']) && empty($_SESSION['passwordError']) && empty($_SESSION['confirmError'])) {
    // Prepare an insert statement
    $addUser = $database->query("INSERT INTO users (username, password) VALUES (?, ?)");
    $passwordOptions = [ 'cost' => 13 ]; // Make the password somewhat difficult to crack
    $addUser->execute($username, password_hash($password, PASSWORD_BCRYPT, $passwordOptions)); // Hash the password with Bcrypt

    // Attempting to execute the prepared statement
    if($addUser->errorCode() == 0) // Check for errors
        header('location: login.php'); // Redirect to login page if the query went through successfully

    else
        echo 'Something went wrong. Please try again later.'; // Otherwise, show an error
}
