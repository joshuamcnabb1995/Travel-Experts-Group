<!--
   Author:  Corinne Mullan
   Date:  06-05-2018
   Description:  Process the package booking request.
-->

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
        include('../../inc/database.php');

        $loggedin = isset($_COOKIE["uid"]);

        # $result will be set to false on any database query errors
        $result = true;

        # If the user is not logged in, store the user information in the customer table.
        # The CustomerId will be autoincremented so does not need to be included.
        # At this point, leave the agentId blank as the customer is not associated with an
        # agent at this point, and they have made the booking online themselves.
        if (!$loggedin) {
            $values = "''" . $_POST["fn"] . "', ";
            $values .= "'" . $_POST["ln"] . "', ";
            $values .= "'" . $_POST["ad"] . "', ";
            $values .= "'" . $_POST["ct"] . "', ";
            $values .= "'" . $_POST["pv"] . "', ";
            $values .= "'" . $_POST["pc"] . "', ";
            $values .= "'" . $_POST["cn"] . "', ";
            $values .= "'" . $_POST["hp"] . "', ";
            $values .= "'" . $_POST["bp"] . "', ";
            $values .= "'" . $_POST["em"] . "'";

            $sql = "INSERT INTO customers ";
            $sql .= "(CustFirstName, CustLastName, CustAddress, CustCity, CustProv, CustPostal, CustCountry, CustHomePhone, CustBusPhone, CustEmail)";
            $sql .= " VALUES (" . $values . ")";

            $result = $database->query($sql);
        }

        # Retrieve the customerId from the database.  This assumes the customer first name,
        # last name, and email together uniquely identify the customer.
        if ($result) {
            $sql = "SELECT CustomerId FROM customers WHERE CustFirstName = '" . $_POST["fn"] . "' AND ";
            $sql .= "CustLastName = '" . $_POST["ln"] . "' AND ";
            $sql .= "CustEmail = '" . $_POST["email"] . "'";
            $result = $database->query($sql);
            if ($result) {
              $customerid = $result->fetch();
            }
        }

        # Only continue with the addition of the booking record if a customer id was
        # successfully retrieved
        if ($result) {

            $bookingDate = date('Y-m-d');

            # Randomly generate a string of 7 digits/letters for the booking number.  Use
            # the uniqid() function, convert the letters to upper case, and truncate to 7
            # characters to match the booking numbers already in the database.

            # For the prototype, assume all the packages that can be booked have a trip
            # type of "L" for leisure
            $bookingNumber = substr(strtoupper(uniqid()),0,7);

            $values = "''" . $bookingDate . "', ";
            $values .= "'" . $bookingNumber . "', ";
            $values .= "'" . $_SESSION["qty"] . "', ";
            $values .= "'" . $customerid . "', ";
            $values .= "'L', ";
            $values .= "'" . $_SESSION["packageid"] . "'";

            $sql = "INSERT INTO bookings ";
            $sql .= "(BookingDate, BookingNo, TravellerCount, CustomerId, TripTypeId, PackageId)";
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
