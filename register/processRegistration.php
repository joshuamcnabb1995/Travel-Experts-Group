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
                   Added additional validation for all form fields (Everything except username, email, password and confirm)
                   Added function to generate errors
    */

    include('../inc/global.php'); // Database configuration and other checks

    $registrationForm = $_POST; // Store all the elements in the form as a variable so they can be looped through
    $formErrors = 0; // By default, there's no form errors, but they can be added

    // Function to handle error creation to reduce repetition
    function generateError($field, $errorMessage)
    {
        $_SESSION[$field . 'Error_register'] = $errorMessage; // Store the error message as a session so it can be viewed on the registration page
        global $formErrors; // Declare the variable as global so it can be accessed outside the function
        $formErrors += 1; // Add a new error everytime the function runs
    }

    // Loop through all the form elements and save them as variables and sessions
    foreach($registrationForm as $key => $value) {
        $$key = $value; // Store each form value as a variable based on the key in the POST array ($username, $email, etc.)
        $_SESSION['register_' . $key] = trim($value); // Remove whitespace from beginning and end of each form value and store it as a session so the user doesn't have to enter their information again
    }

    // Validate first name
    if(empty($firstname)) generateError('firstname', 'Please enter a first name.');
    else if(strlen($firstname) < 2 || strlen($firstname) > 25) generateError('firstname', 'First name must be between 2 and 25 characters long');
    else if(!preg_match('/[a-zA-z]/', $firstname)) generateError('firstname', 'First name can only contain letters.');
    // Validate first name

    // Validate last name
    if(empty($lastname)) generateError('lastname', 'Please enter a last name.');
    else if(strlen($lastname) < 2 || strlen($lastname) > 25) generateError('lastname', 'Last name must be between 2 and 25 characters long');
    else if(!preg_match('/[a-zA-z]/', $lastname)) generateError('lastname', 'Last name can only contain letters.');
    // Validate last name

    // Validate Address
    if(!empty($address)) { // Only validate address if the user has entered data into it
        if(strlen($address) < 10 || strlen($address) > 75) generateError('address', 'Address must be between 10 and 75 characters long.');
        else if(!preg_match("/[\w',-\\.\s]/", $address)) generateError('address', 'Invalid format (Letters, numbers spaces and - only).');
    }
    // Validate address

    // Validate city
    if(!empty($city)) {
        if(strlen($city) < 3 || strlen($city) > 50) generateError('city', 'City must be between 3 and 50 characters long.');
        else if(!preg_match('/[a-zA-z]/', $address)) generateError('city', 'Invalid format (letters only).');
    }
    // Validate city

    // Validate province
    if($province != 'Choose Province') {
        if(strlen($province) != 2) generateError('province', 'Province must be exactly 2 characters long.');
        else if(!preg_match('/[a-zA-z]/', $province)) generateError('province', 'Invalid format (letters only).');
    }
    // Validate province

    // Validate postal code
    if(!empty($postalcode)) {
        if(strlen($postalcode) != 7) generateError('postalcode', 'Postal code must be exactly 7 characters long.');
        else if(!preg_match('/^[ABCEGHJKLMNPRSTVXY]\d[ABCEGHJKLMNPRSTVWXYZ] *\d[ABCEGHJKLMNPRSTVWXYZ]\d$/', $postalcode))
            generateError('postalcode', 'Postal code format invalid (N1N 1N1).');
    }
    // Validate postal code

    // Validate country
    if(!empty($country)) {
        if(strlen($country) < 2 || strlen($country) > 25) generateError('country', 'Country must be between 2 and 25 characters long.');
        else if(!preg_match('/[a-zA-z]/', $country)) generateError('Invalid country format (letters only).');
    }
    // Validate country

    // Validate home phone
    if(!empty($homephone))
        if(strlen($homephone) < 11 || strlen($homephone) > 20) generateError('homephone', 'Home phone must be between 11 and 20 characters.');
    // Validate home phone

    // Validate business phone
    if(!empty($businessphone))
        if(strlen($businessphone) < 11 || strlen($businessphone) > 20) generateError('businessphone', 'Home phone must be between 11 and 20 characters.');
    // Validate business phone

    // Validate Email
    if(empty($email)) generateError('email', 'Please enter an email address.');
    else if(!preg_match('/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/', $email))
        generateError('email', 'Invalid email format.');
    else {
        $getEmail = $database->prepare("SELECT CustomerId FROM customers WHERE CustEmail = ?"); // Prepare a select statement
        $getEmail->execute([$email]); // Execute the prepared statement with the placeholder

        // Email address belongs to another customer
        if($getEmail->rowCount() == 1) generateError('email', 'Email address already in use.');
    }

    // Validate username
    if(empty($username)) generateError('username', 'Please enter a username.');
    else if(strlen($username) < 2 || strlen($username) > 25) generateError('username', 'Username must be between 2 and 25 characters long.');
    else {
        $getUser = $database->prepare("SELECT CustUsername FROM Customers WHERE CustUsername = ?");
        $getUser->execute([$username]);

        if($getUser->rowCount() == 1) generateError('username', 'This username is taken.');
    }
    // Validate username

    // Validate password
    if(empty($password)) generateError('password', 'Please enter a password');
    else if(strlen($password) < 6) generateError('password', 'Password must have atleast 6 characters.');
    // Validate password

    // Validate confirm password
    if(empty($confirm)) generateError('confirm', 'Please confirm your password.');
    else if($password != $confirm) generateError('confirm', 'Passwords do not match.');

    // Check form errors before inserting in database
    if($formErrors == 0) {
        $uid = md5(openssl_random_pseudo_bytes(32)); // Randomly generated, cryptographically secure UID (Joshua)
        $passwordOptions = [ 'cost' => 13 ]; // Make the password somewhat difficult to crack (Joshua)
        $password = password_hash($password, PASSWORD_BCRYPT, $passwordOptions); // Hash the password with Bcrypt so it's more secure than a plaintext password (Joshua)

        $addUser = $database->prepare("INSERT INTO customers(CustFirstName, CustLastName, CustAddress, CustCity, CustProv, CustPostal, CustCountry, CustHomePhone, CustBusPhone, CustEmail, CustUsername, CustPassword, CustUID) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $addUser->execute([$firstname, $lastname, $address, $city, $province, $postalcode, $country, $homephone,
                          $businessphone, $email, $username, $password, $uid]);

        if($addUser->errorCode() == 0) { // Check for errors
            // If the query went through successfully and a new customer was created, log that customer in so they don't have to do it themselves
            setcookie('uid', $uid, strtotime('+1 year'), '/', 'localhost', false, true); // Set cookie to expire in 1 year
            header('Location: ../');
        }

        else
            echo 'Unfortunately, a new customer account couldn\'t be created. We have sent this error to our IT Department and are working hard to solve it.'; // Otherwise, show an error
    }

    else {
        $_SESSION['formErrors'] = $formErrors;
        header('Location: index.php'); // Redirect back to the login page so the errors can be shown under the appropriate fields
    }
