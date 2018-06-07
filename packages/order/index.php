<!--
   Author:  Corinne Mullan
   Date:  06-04-2018
   Description:  Create the form and PHP script to handle package bookings.
-->


<?php
    # Set the $page variable to be that of the packages page.  The orders page itself
    # does not appear in the navigation menu as the user should not navigate directly to
    # the orders page
    $page = 2;
    include('../../inc/global.php');

    # Include the Customer class definition
    include("../inc/classes/customer.php");

    # Check if the user is logged in.  If so, create a Customer object.  The customer
    # constructor will create a customer object and populate it with the data from the
    # customers table in the database when it is passed a userid

    $loggedin = isset($_COOKIE["uid"]);
    if ($loggedin) {
      $customer = new Customer($_COOKIE["uid"]);
    }
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
        $_SESSION["pkgid"] = $_POST["packageId"];
        $_SESSION["qty"] = $_POST["qty"];

        # Do some basic error checking.  Ensure that the package id exists in the $database
        # and the number of travellers is > 0.  In case of an error, set the $_SESSION["ordererror"]
        # variable and return to the packages page
        if (($_SESSION["qty"] < 1)) {
          $_SESSION["ordererror"] = true;
          header("Location:../index.php");
          exit();
        }

        $sql = "SELECT * FROM packages where PackageId = " . "'" . $_SESSION["pkgid"] . "'";
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
          echo "<b>Number of Travellers: </b>" . $_SESSION["qty"] . "<br><br>";

          printf("<b>TOTAL PRICE:  $%9.2f</b><br><br>", $row["PkgBasePrice"] * $_SESSION["qty"]);
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
                  <label for="fn">First Name<sup>*</sup>&nbsp;<small class="text-muted">&nbsp;Required</small></label>
                  <input type="text" class="form-control" id="fn" name="fn" value="<?php echo ($loggedin ? $customer->firstname:''); ?>">
                </div>
                <div class="form-group col-md-6">
                  <label for="ln">Last Name<sup>*</sup></small></label>
                  <input type="text" class="form-control" id="ln" name="ln" value="<?php echo ($loggedin ? $customer->lastname:''); ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="ad">Address</label>
                <input type="text" class="form-control" id="ad" name="ad" value="<?php echo ($loggedin ? $customer->address:''); ?>">
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="ct">City</label>
                  <input type="text" class="form-control" id="ct" name="ct" value="<?php echo ($loggedin ? $customer->city:''); ?>">
                </div>
                <div class="form-group col-md-4">
                  <label for="pv">Province</label>
                  <select id="pv" class="form-control">
                    <option <?php echo ($loggedin ? "":"selected"); ?>>Choose Province</option>
                    <option <?php echo (($loggedin && $customer.province=="AB") ? "selected":""); ?>>AB</option>
                    <option <?php echo (($loggedin && $customer.province=="BC") ? "selected":""); ?>>BC</option>
                    <option <?php echo (($loggedin && $customer.province=="MB") ? "selected":""); ?>>MB</option>
                    <option <?php echo (($loggedin && $customer.province=="NB") ? "selected":""); ?>>NB</option>
                    <option <?php echo (($loggedin && $customer.province=="NL") ? "selected":""); ?>>NL</option>
                    <option <?php echo (($loggedin && $customer.province=="NS") ? "selected":""); ?>>NS</option>
                    <option <?php echo (($loggedin && $customer.province=="NT") ? "selected":""); ?>>NT</option>
                    <option <?php echo (($loggedin && $customer.province=="NU") ? "selected":""); ?>>NU</option>
                    <option <?php echo (($loggedin && $customer.province=="ON") ? "selected":""); ?>>ON</option>
                    <option <?php echo (($loggedin && $customer.province=="PE") ? "selected":""); ?>>PE</option>
                    <option <?php echo (($loggedin && $customer.province=="QC") ? "selected":""); ?>>QC</option>
                    <option <?php echo (($loggedin && $customer.province=="SK") ? "selected":""); ?>>SK</option>
                    <option <?php echo (($loggedin && $customer.province=="YT") ? "selected":""); ?>>YT</option>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label for="pc">Postal Code</label>
                  <input type="text" class="form-control" id="pc" name="pc" value="<?php echo ($loggedin ? $customer->postalcode:''); ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="cn">Country</label>
                <input type="text" class="form-control" id="cn" name="cn" value="<?php echo ($loggedin ? $customer->country:'Canada'); ?>">
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="hp">Home Phone</label>
                  <input type="tel" class="form-control" id="hp" name="hp" value="<?php echo ($loggedin ? $customer->homephone:''); ?>">
                </div>
                <div class="form-group col-md-6">
                  <label for="bp">Business Phone</label>
                  <input type="tel" class="form-control" id="bp" name="bp" value="<?php echo ($loggedin ? $customer->businessphone:''); ?>">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="em">Email<sup>*</sup></label>
                  <input type="email" class="form-control" id="em" name="em" value="<?php echo ($loggedin ? $customer->email:''); ?>">
                </div>
              </div>

              <div class="form-group">
                <input type="submit" name="booktrip" class="btn btn-primary" value="Book Trip">
                <input type="button" class="btn btn-default" value="Cancel" onclick="window.location.href='../index.php'">
              </div>

            </form>

            <!-- If no user is logged in, give the customer the option of going into the login page -->
            <?php
            if (!$loggedin) {
              echo "<p>Already have an account? <a href='../../login/index.php'>Login here</a></p>";
            }
            ?>

          </div>
        </div>
      </div>

      <?php include('../../inc/javascript.php'); ?>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>

      <script>

      $(document).ready(function(){
        $('#fn').popover({content: "Please enter your first name", placement: "top", trigger: "focus"});
        $('#ln').popover({content: "Please enter your last name", placement: "top", trigger: "focus"});
        $('#ad').popover({content: "Please enter your address", placement: "top", trigger: "focus"});
        $('#ct').popover({content: "Please enter your city", placement: "top", trigger: "focus"});
        $('#pv').popover({content: "Please select your province", placement: "bottom", trigger: "focus"});
        $('#pc').popover({content: "Please enter your postal code as A1A 1A1", placement: "top", trigger: "focus"});
        $('#cn').popover({content: "Please enter your country", placement: "top", trigger: "focus"});
        $('#hp').popover({content: "Please enter your home phone number as a 10 digit number", placement: "top", trigger: "focus"});
        $('#bp').popover({content: "Please enter your business phone number as a 10 digit number", placement: "top", trigger: "focus"});
        $('#em').popover({content: "Please enter your email address", placement: "top", trigger: "focus"});
        $('#id').popover({content: "Please choose a user ID containing only letters and numbers", placement: "top", trigger: "focus"});
        $('#p1').popover({content: "Please choose a password", placement: "top", trigger: "focus"});
        $('#p2').popover({content: "Please re-enter the password", placement: "top", trigger: "focus"});

        // The postal code should be in the form A1A 1A1
        $.validator.methods.postalcode = function( value, element ) {
            return this.optional( element ) || /^[A-Za-z]\d[A-Za-z]\s\d[A-Za-z]\d$/.test( value );
        }

        $('#customerform').validate({
          rules: {
            fn: {
              required: true
            },
            ln: {
              required: true
            },
            pc: {
              postalcode: true
            },
            bp: {
              minlength: 10,
              maxlength: 10,
              digits: true
            },
            hp: {
              minlength: 10,
              maxlength: 10,
              digits: true
            },
            em: {
              required: true,
              email: true
            }
          },
          messages: {
            pc: {
              postalcode: "Postal code should be in the form A1A 1A1"
            },
            bp: {
              minlength: "Business phone number should be 10 digits",
              maxlength: "Business phone number should be 10 digits",
              digits: "Business phone number should contain only digits"
            },
            hp: {
              minlength: "Home phone number should be 10 digits",
              maxlength: "Home phone number should be 10 digits",
              digits: "Home phone number should contain only digits"
            },
            em: {
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
