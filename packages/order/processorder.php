<!--
   Author:  Corinne Mullan
   Date:  06-05-2018
   Description:  Process the package booking request.
-->

<?php
  session_start();
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
        include('../../inc/database.php');

        # Include the Customer class definition
        include("../inc/classes/customer.php");

        # If the user has somehow reached this page without being logged in, set
        # $_SESSION["ordererror"] and return to the packages page
        $loggedin = isset($_COOKIE["uid"]);
        if (!$loggedin) {
          $_SESSION["ordererror"] = true;
          header("Location:../index.php");
          exit();
        }

        # The customer will always be logged in at this point, so there is no need
        # to add a record to the customers table in the database, as this was done
        # during the registration process.

        # Create a customer object from the userid
        $customer = new Customer($_COOKIE["uid"]);

        # Now add a new booking record into the bookings table
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
        $values .= "'" . $customerid["CustomerId"] . "', ";
        $values .= "'L', ";
        $values .= "'" . $_SESSION["id"] . "'";

        $sql = "INSERT INTO bookings ";
        $sql .= "(BookingDate, BookingNo, TravelerCount, CustomerId, TripTypeId, PackageId)";
        $sql .= " VALUES (" . $values . ")";

        $result = $database->query($sql);

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
