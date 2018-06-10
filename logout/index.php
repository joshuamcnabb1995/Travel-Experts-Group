<?php
    include('../inc/global.php');
    include('../inc/classes/Customer.php');

    // Log the customer out and return them to the homepage
    if($Customer->logout())
        header('Location: ../');
