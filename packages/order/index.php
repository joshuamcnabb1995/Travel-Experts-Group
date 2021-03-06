<!--
   Author:  Corinne Mullan
   Date:  06-08-2018
   Description:  Create the form and PHP script to handle package bookings.
-->


<?php
    # Note that global.php contains the session_start() command so that the $_SESSION
    # variables can be accessed by this page
    $page = 2;
    include('../../inc/global.php');

    # Include the Customer class definition
    include("../../inc/classes/Customer.php");

    # The user should be logged in to reach this page.  In case the user has somehow
    # reached this page without logging in, set $_SESSION["ordererror"] and return to the
    # packages page.

    $loggedin = isset($_COOKIE["uid"]);
    if (!$loggedin) {
        $_SESSION["odererror"] = true;
        header("Location:../index.php");
        exit();
    }

    # Create a Customer object.  The customer constructor will create a customer object and
    # populate it with the data from the customers table in the database when it is passed a userid
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

    <!-- Populate the form based on the customer data  and with the selected package. -->

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
        if(isset($_POST["quantity"])) $_SESSION["quantity"] = $_POST["quantity"];

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
        ?>
        <div class="card">
            <div class="card-header">
                <h5>Order Details</h5>
            </div>

            <div class="card-body" style="padding:10px;">
                <?php
                    echo "<div style=\"float:left;\"><img src=\"../../img/packages/package" . $row['PackageId'] . ".jpg\" style=\"width:285px;height:200px;margin-right:15px;\" /></div>";
                    echo "<b>Package Name: </b>" . $row["PkgName"] . "<br>";
                    echo "<b>Description: </b>" . $row["PkgDesc"] . "<br>";
                    echo "<b>Start Date: </b>" . $row["PkgStartDate"] . "<br>";
                    echo "<b>End Date:&nbsp;&nbsp;&nbsp;</b>" . $row["PkgEndDate"] . "<br>";
                    echo "<b>Cost per Person: <span style=\"color:green;\">$" . number_format($row["PkgBasePrice"], 2, '.', '') . "</span></b><br>";
                    echo "<b>Number of Travellers: </b>" . $_SESSION["quantity"] . "<br><br>";
                    echo "<b style=\"color:green;\">TOTAL PRICE: $" . number_format($row["PkgBasePrice"] * $_SESSION["quantity"], 2, '.', '') . "</b><br><br>";
                }
                ?>
            </div>
        </div><br />

        <div class="card">
          <div class="card-header">
            <h5>Booking Details</h5>
          </div>
          <div class="card-body">
            <p class="card-text"><h6>Please complete this form to make a booking</h6></p>
            <br>

            <!-- Auto-populate the input fields in the form with the customer data obtained
            from the database. -->
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
                  <label for="city">City</label>
                  <input type="text" class="form-control" id="city" name="city" value="<?php echo $customer->getInfo('CustCity'); ?>">
                </div>
                <div class="form-group col-md-4">
                  <label for="province">Province</label>
                  <select id="province" name="province" class="form-control">
                    <option>Choose Province</option>
                    <option <?php echo ($customer->getInfo("CustProv")=="AB" ? "selected":""); ?>>AB</option>
                    <option <?php echo ($customer->getInfo("CustProv")=="BC" ? "selected":""); ?>>BC</option>
                    <option <?php echo ($customer->getInfo("CustProv")=="MB" ? "selected":""); ?>>MB</option>
                    <option <?php echo ($customer->getInfo("CustProv")=="NB" ? "selected":""); ?>>NB</option>
                    <option <?php echo ($customer->getInfo("CustProv")=="NL" ? "selected":""); ?>>NL</option>
                    <option <?php echo ($customer->getInfo("CustProv")=="NS" ? "selected":""); ?>>NS</option>
                    <option <?php echo ($customer->getInfo("CustProv")=="NT" ? "selected":""); ?>>NT</option>
                    <option <?php echo ($customer->getInfo("CustProv")=="NU" ? "selected":""); ?>>NU</option>
                    <option <?php echo ($customer->getInfo("CustProv")=="ON" ? "selected":""); ?>>ON</option>
                    <option <?php echo ($customer->getInfo("CustProv")=="PE" ? "selected":""); ?>>PE</option>
                    <option <?php echo ($customer->getInfo("CustProv")=="QC" ? "selected":""); ?>>QC</option>
                    <option <?php echo ($customer->getInfo("CustProv")=="SK" ? "selected":""); ?>>SK</option>
                    <option <?php echo ($customer->getInfo("CustProv")=="YT" ? "selected":""); ?>>YT</option>
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
      <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

      <script>

      $(document).ready(function(){
        $('#firstname').popover({content: "Please enter your first name", placement: "top", trigger: "focus"});
        $('#lastname').popover({content: "Please enter your last name", placement: "top", trigger: "focus"});
        $('#address').popover({content: "Please enter your address", placement: "top", trigger: "focus"});
        $('#city').popover({content: "Please enter your city", placement: "top", trigger: "focus"});
        $('#province').popover({content: "Please select your province", placement: "top", trigger: "focus"});
        $('#postalcode').popover({content: "Please enter your postal code as A1A 1A1", placement: "top", trigger: "focus"});
        $('#country').popover({content: "Please enter your country", placement: "top", trigger: "focus"});
        $('#homephone').popover({content: "Please enter your home phone number as a 10 digit number", placement: "top", trigger: "focus"});
        $('#businessphone').popover({content: "Please enter your business phone number as a 10 digit number", placement: "top", trigger: "focus"});
        $('#email').popover({content: "Please enter your email address", placement: "top", trigger: "focus"});

        $('#homephone').mask('1 (000) 000-0000', {'translation': {0: {pattern: /[0-9]/}}});
        $('#businessphone').mask('1 (000) 000-0000', {'translation': {0: {pattern: /[0-9]/}}});

        // The postal code should be in the form A1A 1A1
        $.validator.methods.postalcode = function( value, element ) {
            return this.optional( element ) || /^[A-Za-z]\d[A-Za-z]\s\d[A-Za-z]\d$/.test( value );
        }

        // Provide a custom method to validate the phone number with the mask
        $.validator.methods.phone = function( value, element ) {
            return this.optional( element ) || /^1 \(\d{3}\) \d{3}-\d{4}$/.test( value );
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
            },
            homephone: {
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
              phone: "Enter digits only for the home phone number"
            },
            homephone: {
              phone: "Enter digits only for the business phone number"
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
