<?php
    include('./inc/global.php');
    include('./inc/classes/Customer.php');

    $Customer = new Customer($_COOKIE['uid']);

    echo $Customer->getInfo('CustFirstName');
