<?php
    class Customer
    {
        public function __construct($uid) {
            $this->uid = $uid;
        }

        public function loggedIn() {
            global $database; // Access the database object inside the class
            $getCustomer = $database->prepare("SELECT CustomerId FROM customers WHERE CustomerUID = ? LIMIT 1");
            $getCustomer->execute([$this->uid]);

            // If the UID cookie exists and it matches the uid in the database, the customer is logged in
            if(isset($_COOKIE['uid']) $getCustomer->rowCount() == 1)
                return TRUE;

            else
                return FALSE;
        }

        public function getData($field) {
            global $database;

            $getCustomerData = $database->query("SELECT $field FROM customers WHERE uid = ?");
            $getCustomerData->execute([$this->uid]);
        }
    }
