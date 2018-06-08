<?php
    class Customer
    {
        public function __construct($uid) {
            $this->uid = $uid;
        }

        public function getInfo($field) {
            global $database;

            $getCustomerData = $database->prepare("SELECT $field FROM customers WHERE CustUID = ?");
            $getCustomerData->execute([$this->uid]);
            $customerData = $getCustomerData->fetch();

            return $customerData[$field];
        }
    }
