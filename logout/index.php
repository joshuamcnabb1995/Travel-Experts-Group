<?php
    include('../inc/global.php');
    include('../inc/classes/Customer.php');

    $Customer = new Customer($_COOKIE['uid']);

    // Log the customer out and return them to the homepage
    if($Customer->logout())
        header('Location: ../');
