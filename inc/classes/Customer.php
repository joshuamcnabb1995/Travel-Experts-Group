<?php
    // Class created by Joshua McNabb
    class Customer
    {
        public function __construct($uid) {
            $this->uid = $uid;
        }

        // Method to return customer's information from the database depending on which field is passed as an argument
        public function getInfo($field) {
            global $database; // Need to declare the pdo object instantiation as global otherwise it cannot be accessed

            $getCustomerData = $database->prepare("SELECT $field FROM customers WHERE CustUID = ?"); // Select data based on the value in the UID cookie
            $getCustomerData->execute([$this->uid]);
            $customerData = $getCustomerData->fetch(); // Fetch the single row

            return $customerData[$field]; // Return the array with the index being the name of the field
        }

        public function logout() {
            setcookie('uid', $UID['CustUID'], strtotime('-1 year'), '/', 'localhost', false, true); // Set cookie to a negative value to delete it

            $_SESSION['logged_out'] = 1; // Display a message on the homepage when the customer has been successfully logged out
            return TRUE; // Allow the logout page to redirect the customer back to the homepage when they're logged out
        }
    }
