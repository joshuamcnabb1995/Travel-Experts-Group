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

        #$pkgId = $_POST["packageId"];
        #$bookingDate = $_POST["bookingDate"];

        // Insert a record into the customer table if necessary
        // ADD if (!logged in) {}

        #$result->query($sql);
        $result=false;



        // Insert a record into the booking table


        # If the database was updated successfully, give a success message and provide a link
        # for the user to return to the main Travel Experts page
        if ($result) {
          echo "<h1>Your vacation was booked successfully!</h1><br><br>";
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
