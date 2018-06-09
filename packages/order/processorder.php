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
        # be updated with any information changed by the user on the orders form.  Go
        # through the input fields to see if any have changed, and create a SQL query
        # to update the modified fields.

        # The following section of code has been designed to minimize the number of
        # database operations performed.  A single SQL statement is generated to update
        # all the modified customer fields at once.
        $updatestring = "";

        $existingValue = $customer->getInfo("CustFirstName");
        if ($_POST["firstname"] != $existingValue) {
              $updatestring .= ", CustFirstName = '" . $_POST["firstname"] . "'";
        }

        $existingValue = $customer->getInfo("CustLastName");
        if ($_POST["lastname"] != $existingValue) {
              $updatestring .= ", CustLastName = '" . $_POST["lastname"] . "'";
        }

        $existingValue = $customer->getInfo("CustAddress");
        if ($_POST["address"] != $existingValue) {
              $updatestring .= ", CustAddress = '" . $_POST["address"] . "'";
        }

        $existingValue = $customer->getInfo("CustCity");
        if ($_POST["city"] != $existingValue) {
              $updatestring .= ", CustCity = '" . $_POST["city"] . "'";
        }

        $existingValue = $customer->getInfo("CustProv");
        if ($_POST["province"] != $existingValue) {
              $updatestring .= ", CustProv = '" . $_POST["province"] . "'";
        }

        $existingValue = $customer->getInfo("CustPostal");
        if ($_POST["postalcode"] != $existingValue) {
              $updatestring .= ", CustPostal = '" . $_POST["postalcode"] . "'";
        }

        $existingValue = $customer->getInfo("CustCountry");
        if ($_POST["country"] != $existingValue) {
              $updatestring .= ", CustCountry = '" . $_POST["country"] . "'";
        }

        $existingValue = $customer->getInfo("CustHomePhone");
        if ($_POST["homephone"] != $existingValue) {
              $updatestring .= ", CustHomePhone = '" . $_POST["homephone"] . "'";
        }

        $existingValue = $customer->getInfo("CustBusPhone");
        if ($_POST["businessphone"] != $existingValue) {
              $updatestring .= ", CustBusPhone = '" . $_POST["businessphone"] . "'";
        }

        $existingValue = $customer->getInfo("CustEmail");
        if ($_POST["email"] != $existingValue) {
              $updatestring .= ", CustEmail = '" . $_POST["email"] . "'";
        }

        # If there are fields in the customers table to update, create and execute
        # the SQL query
        if (strlen($updatestring) > 0) {
          # Remove the extraneous comma and space at the start of the string
          $updatestring = substr($updatestring, 2, strlen($updatestring)-2);

          $sql = "UPDATE customers SET " . $updatestring;
          $sql .= " WHERE CustUID = '" . $customer->uid . "'";
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
