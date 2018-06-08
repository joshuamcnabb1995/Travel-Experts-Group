<!--
   Author:  Corinne Mullan
   Date:  06-04-2018
   Description:  Create the form and PHP script to handle package bookings.
-->


<?php
    # Allow access to the $_SESSION[] variables
    session_start();

    # Set the $page variable to be that of the packages page.  The orders page itself
    # does not appear in the navigation menu as the user should not navigate directly to
    # the orders page
    $page = 2;
    include('../../inc/global.php');

    # Include the Customer class definition
    include("../inc/classes/customer.php");

    # The user is only able to access the orders page from the packages page when they
    # are logged in.  Confirm here that the user is logged in just in case they have managed
    # to access the orders page directly, rather than through the packages page.  If no user
    # is logged in, set $_SESSIOn["ordererror"] and return to the packages page.
    $loggedin = isset($_COOKIE["uid"]);

    if (!$loggedin) {
      $_SESSION["ordererror"] = true;
      header("Location:../index.php");
      exit();
    }

    # The Customer class constructor will create a customer object and populate it with the
    # data from the customers table in the database when it is passed a userid
    $customer = new Customer($_COOKIE["uid"]);

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

    <?php include('../../inc/navigation.php'); ?>

    <!-- Need to populate the form based on the customer data (if the customer is logged in)
    and with the selected package.  Need to add field in form to show the selected package
    plus a program-generated booking number.  The customer must add the number of travellers. -->

    <div class="container" style="margin-top:80px; margin-bottom:80px;">

      <?php
        # This section of PHP code retrieves and displays the package details for the
        # customer's order
        include('../../inc/database.php');

        # The packageId and the number of travellers have been passed from the packages
        # page in $_POST.  Use packageId to obtain the package details from the database
        # and use the number of travellers to calculate the total cost.

        # The package id and number of travellers have been placed in $_POST when the
        # order button is clicked on the packages page.  Save these into $_SESSION variables
        # so that they are readily accessible to processorder.php.
        $_SESSION["id"] = $_POST["id"];
        $_SESSION["quantity"] = $_POST["quantity"];

        # Do some basic error checking.  Ensure that the package id exists in the $database
        # and the number of travellers is > 0.  In case of an error, set the $_SESSION["ordererror"]
        # variable and return to the packages page
        if (($_SESSION["quantity"] < 1)) {
          $_SESSION["ordererror"] = true;
          header("Location:../index.php");
          exit();
        }

        $sql = "SELECT * FROM packages where PackageId = " . "'" . $_SESSION["id"] . "'";
        $result = $database->query($sql);

        if (!$result) {
          $_SESSION["ordererror"] = true;
          header("Location:../index.php");
          exit();
        }
        else {
          # On success, display the order details for the user to review before
          # filling out the form.
          # Note that only one row will be returned from the query to the packages table.
          $row = $result->fetch();
          echo "<b>Package Name: </b>" . $row["PkgName"] . "<br>";
          echo "<b>Description: </b>" . $row["PkgDesc"] . "<br>";
          echo "<b>Start Date: </b>" . $row["PkgStartDate"] . "<br>";
          echo "<b>End Date:&nbsp;&nbsp;&nbsp;</b>" . $row["PkgEndDate"] . "<br>";
          printf("<b>Cost per Person:  $%9.2f</b><br>", $row["PkgBasePrice"]);
          echo "<b>Number of Travellers: </b>" . $_SESSION["quantity"] . "<br><br>";

          printf("<b>TOTAL PRICE:  $%9.2f</b><br><br>", $row["PkgBasePrice"] * $_SESSION["quantity"]);
        }
        ?>

        <div class="card">
          <div class="card-header">
            <h5>Package Booking</h5>
          </div>
          <div class="card-body">
            <p class="card-text"><h6>Please complete this form to make a booking</h6></p>
            <br>

            <!-- If the customer is logged in, auto-populate the input fields in the form with
            the customer data obtained from the database. -->
            <form id="customerform" action="processorder.php" method="post">

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="firstname">First Name<sup>*</sup>&nbsp;<small class="text-muted">&nbsp;Required</small></label>
                  <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $customer->getInfo('CustFirstName'); ?>">
                </div>
                <div class="form-group col-md-6">
                  <label for="lastname">Last Name<sup>*</sup></small></label>
                  <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $customer->getInfo('CustLastName'); ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="<?php echo $customer->getInfo('CustAddress'); ?>">
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="ct">City</label>
                  <input type="text" class="form-control" id="city" name="city" value="<?php echo $customer->getInfo('CustCity'); ?>">
                </div>
                <div class="form-group col-md-4">
                  <label for="province">Province</label>
                  <select id="province" name="province" class="form-control">
                    <option>Choose Province</option>
                    <option <?php echo ($customer->getInfo('CustProvince') =="AB") ? "selected":""; ?>>AB</option>
                    <option <?php echo ($customer->getInfo('CustProvince') =="BC") ? "selected":""; ?>>BC</option>
                    <option <?php echo ($customer->getInfo('CustProvince') =="MB") ? "selected":""; ?>>MB</option>
                    <option <?php echo ($customer->getInfo('CustProvince') =="NB") ? "selected":""; ?>>NB</option>
                    <option <?php echo ($customer->getInfo('CustProvince') =="NL") ? "selected":""; ?>>NL</option>
                    <option <?php echo ($customer->getInfo('CustProvince') =="NS") ? "selected":""; ?>>NS</option>
                    <option <?php echo ($customer->getInfo('CustProvince') =="NT") ? "selected":""; ?>>NT</option>
                    <option <?php echo ($customer->getInfo('CustProvince') =="NU") ? "selected":""; ?>>NU</option>
                    <option <?php echo ($customer->getInfo('CustProvince') =="ON") ? "selected":""; ?>>ON</option>
                    <option <?php echo ($customer->getInfo('CustProvince') =="PE") ? "selected":""; ?>>PE</option>
                    <option <?php echo ($customer->getInfo('CustProvince') =="QC") ? "selected":""; ?>>QC</option>
                    <option <?php echo ($customer->getInfo('CustProvince') =="SK") ? "selected":""; ?>>SK</option>
                    <option <?php echo ($customer->getInfo('CustProvince') =="YT") ? "selected":""; ?>>YT</option>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label for="postalcode">Postal Code</label>
                  <input type="text" class="form-control" id="postalcode" name="postalcode" value="<?php echo $customer->getInfo('CustPostal'); ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="country">Country</label>
                <input type="text" class="form-control" id="country" name="country" value="<?php echo $customer->getInfo('CustCountry'); ?>">
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="homephone">Home Phone</label>
                  <input type="tel" class="form-control" id="homephone" name="homephone" value="<?php echo $customer->getInfo('CustHomePhone'); ?>">
                </div>
                <div class="form-group col-md-6">
                  <label for="businessphone">Business Phone</label>
                  <input type="tel" class="form-control" id="businessphone" name="businessphone" value="<?php echo $customer->getInfo('CustBusPhone'); ?>">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="email">Email<sup>*</sup></label>
                  <input type="email" class="form-control" id="email" name="email" value="<?php echo $customer->getInfo('CustEmail'); ?>">
                </div>
              </div>

              <div class="form-group">
                <input type="submit" name="booktrip" class="btn btn-primary" value="Book Trip">
                <input type="button" class="btn btn-default" value="Cancel" onclick="window.location.href='../index.php'">
              </div>

            </form>

          </div>
        </div>
      </div>

      <?php include('../../inc/javascript.php'); ?>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>

      <script>

      $(document).ready(function(){
        $('#firstname').popover({content: "Please enter your first name", placement: "top", trigger: "focus"});
        $('#lastname').popover({content: "Please enter your last name", placement: "top", trigger: "focus"});
        $('#address').popover({content: "Please enter your address", placement: "top", trigger: "focus"});
        $('#city').popover({content: "Please enter your city", placement: "top", trigger: "focus"});
        $('#province').popover({content: "Please select your province", placement: "bottom", trigger: "focus"});
        $('#postalcode').popover({content: "Please enter your postal code as A1A 1A1", placement: "top", trigger: "focus"});
        $('#country').popover({content: "Please enter your country", placement: "top", trigger: "focus"});
        $('#homephone').popover({content: "Please enter your home phone number as a 10 digit number", placement: "top", trigger: "focus"});
        $('#businessphone').popover({content: "Please enter your business phone number as a 10 digit number", placement: "top", trigger: "focus"});
        $('#email').popover({content: "Please enter your email address", placement: "top", trigger: "focus"});

        // The postal code should be in the form A1A 1A1
        $.validator.methods.postalcode = function( value, element ) {
           return this.optional( element ) || /^[A-Za-z]\d[A-Za-z]\s\d[A-Za-z]\d$/.test( value );
        }

        $('#customerform').validate({
          rules: {
            firstname: {
              required: true
            },
            lastname: {
              required: true
            },
            postalcode: {
              postalcode: true
            },
            businessphone: {
              minlength: 10,
              maxlength: 10,
              digits: true
            },
            homephone: {
              minlength: 10,
              maxlength: 10,
              digits: true
            },
            email: {
              required: true,
              email: true
            }
          },
          messages: {
            postalcode: {
              postalcode: "Postal code should be in the form A1A 1A1"
            },
            businessphone: {
              minlength: "Business phone number should be 10 digits",
              maxlength: "Business phone number should be 10 digits",
              digits: "Business phone number should contain only digits"
            },
            homephone: {
              minlength: "Home phone number should be 10 digits",
              maxlength: "Home phone number should be 10 digits",
              digits: "Home phone number should contain only digits"
            },
            email: {
              email: "Please enter a valid email address"
            }
          }
        });
      });

    </script>

    <!-- Mark the bottom of the page so that, when the page is reloaded after a submit, it reloads with the
  		bottom of the page and buttons showing.  Refer to action="" for the form above. -->
    <a name="bottomOfPage"></a>

    <?php include('../../inc/footer.php'); ?>

  </body>
</html>
