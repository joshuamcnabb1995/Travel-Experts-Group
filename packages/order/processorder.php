<!--
   Author:  Corinne Mullan
   Date:  06-08-2018
   Description:  Process the package booking request.
-->

<?php
  # global.php includes a start_session() command so the $_SESSION[] variables are
  # available in this page
  include('../../inc/global.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Order</title>
    <?php include('../../inc/css.php'); ?>
    <link rel="stylesheet" href="order.css" />
  </head>

  <body>
    <div class="container" style="margin-top:80px; margin-bottom:80px;">
      <?php
        # Include the php for the database connection
        include('../../inc/database.php');

        # Include the Customer class definition
        include("../../inc/classes/Customer.php");

        # If the user has somehow reached this page without being logged in, set
        # $_SESSION["ordererror"] and return to the packages page
        $loggedin = isset($_COOKIE["uid"]);
        if (!$loggedin) {
          $_SESSION["ordererror"] = true;
          header("Location:../index.php");
          exit();
        }

        # Create a customer object from the userid
        $customer = new Customer($_COOKIE["uid"]);

        # $result will capture any errors in the database queries.  Only continue with
        # subsequent database queries if $result is true; i.e., if there have been no
        # previous database errors.
        $result = true;

        # The customer will always be logged in at this point, so there is no need
        # to add a new record to the customers table in the database, as this was done
        # during the registration process.  However, the customers table may need to
        # be updated with any information changed by the user on the orders form.        
        if ($_POST["firstname"] != $customer->getInfo("CustFirstName")) {
            $sql = "UPDATE customers SET CustFirstName = '" . $_POST["firstname"];
            $sql .= "' WHERE CustUID = '" . $customer->uid . "'";
            $result = $database->query($sql);
        }

        if ($result && ($_POST["lastname"] != $customer->getInfo("CustLastName"))) {
            $sql = "UPDATE customers SET CustLastName = '" . $_POST["lastname"];
            $sql .= "' WHERE CustUID = '" . $customer->uid . "'";
            $result = $database->query($sql);
        }

        if ($result && ($_POST["address"] != $customer->getInfo("CustAddress"))) {
            $sql = "UPDATE customers SET CustAddress = '" . $_POST["address"];
            $sql .= "' WHERE CustUID = '" . $customer->uid . "'";
            $result = $database->query($sql);
        }

        if ($result && ($_POST["city"] != $customer->getInfo("CustCity"))) {
            $sql = "UPDATE customers SET CustCity = '" . $_POST["city"];
            $sql .= "' WHERE CustUID = '" . $customer->uid . "'";
            $result = $database->query($sql);
        }

        if ($result && ($_POST["province"] != $customer->getInfo("CustProv"))) {
            $sql = "UPDATE customers SET CustProv = '" . $_POST["province"];
            $sql .= "' WHERE CustUID = '" . $customer->uid . "'";
            $result = $database->query($sql);
        }

        if ($result && ($_POST["postalcode"] != $customer->getInfo("CustPostal"))) {
            $sql = "UPDATE customers SET CustPostal = '" . $_POST["postalcode"];
            $sql .= "' WHERE CustUID = '" . $customer->uid . "'";
            $result = $database->query($sql);
        }

        if ($result && ($_POST["country"] != $customer->getInfo("CustCountry"))) {
            $sql = "UPDATE customers SET CustCountry = '" . $_POST["country"];
            $sql .= "' WHERE CustUID = '" . $customer->uid . "'";
            $result = $database->query($sql);
        }

        if ($result && ($_POST["homephone"] != $customer->getInfo("CustHomePhone"))) {
            $sql = "UPDATE customers SET CustHomePhone = '" . $_POST["homephone"];
            $sql .= "' WHERE CustUID = '" . $customer->uid . "'";
            $result = $database->query($sql);
        }

        if ($result && ($_POST["businessphone"] != $customer->getInfo("CustBusPhone"))) {
            $sql = "UPDATE customers SET CustBusPhone = '" . $_POST["businessphone"];
            $sql .= "' WHERE CustUID = '" . $customer->uid . "'";
            $result = $database->query($sql);
        }

        if ($result && ($_POST["email"] != $customer->getInfo("CustEmail"))) {
            $sql = "UPDATE customers SET CustEmail = '" . $_POST["email"];
            $sql .= "' WHERE CustUID = '" . $customer->uid . "'";
            $result = $database->query($sql);
        }


        # Now add a new booking record into the bookings table
        if ($result) {

          $bookingDate = date('Y-m-d');

          # Randomly generate a string of 7 digits/letters for the booking number.  Use
          # the uniqid() function, convert the letters to upper case, and truncate to the
          # last 7 characters to roughly match the format of the booking numbers already
          # in the database.
          $bookingNumber = substr(strtoupper(uniqid()),6,7);

          # For the prototype, assume all the packages that can be booked have a trip
          # type of "L" for leisure

          $values = "'" . $bookingDate . "', ";
          $values .= "'" . $bookingNumber . "', ";
          $values .= "'" . $_SESSION["quantity"] . "', ";
          $values .= "'" . $customer->getInfo("CustomerId") . "', ";
          $values .= "'L', ";
          $values .= "'" . $_SESSION["id"] . "'";

          $sql = "INSERT INTO bookings ";
          $sql .= "(BookingDate, BookingNo, TravelerCount, CustomerId, TripTypeId, PackageId)";
          $sql .= " VALUES (" . $values . ")";

          $result = $database->query($sql);
        }

        # If the database was updated successfully, give a success message and provide a link
        # for the user to return to the main Travel Experts page
        if ($result) {
          echo "<h1>Your vacation was booked successfully!</h1><br><br>";
          echo "Your booking number is " .  $bookingNumber . "<br><br>";
          echo "<a href='../../index.php'>Click to return to Travel Experts main page</a>";
        }
        # If there was an error updating the database, give an error message and provide
        # a link for the user to return to the orders page
        else {
          echo "<h1 class='error'>Error booking vacation</h1><br><br>";
          echo "<a href='index.php#bottomOfPage'>Click to return to orders page</a>";
        }

      ?>

    </div>
  </body>
</html>
