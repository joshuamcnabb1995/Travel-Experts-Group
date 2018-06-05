<!--
   Author:  Corinne Mullan
   Date:  06-04-2018
   Description:  Create the form and PHP script to handle package bookings.
-->

<!-- Set the $page variable to be that of the packages page.  The orders page itself
does not appear in the navigation menu as the user should not navigate directly to
the orders page -->
<?php
    $page = 2;
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

  <?php include('../../inc/navigation.php'); ?>

  <!-- Need to populate the form based on the customer data (if the customer is logged in)
  and with the selected package.  Need to add field in form to show the selected package
  plus a progra-generating booking number.  The customer must add the number of travellers. -->

  <div class="container" style="margin-top:80px; margin-bottom:80px;">

    <?php
      # This section of PHP code retrieves and displays the package details for the
      # customer's order
      include('../../inc/database.php');

      $currentDate = date('Y-m-d h:i:s');
      echo "<b>Booking Date: </b>" . $currentDate . "<br>";

      # The packageId and the number of travellers have been passed from the packages
      # page in $_POST.  Use packageId to obtain the package details from the database
      # and use the number of travellers to calculate the total cost.

      # CHANGE WHEN WORKING
      #$pkgId = $_POST["packageId"];
      $pkgId = 1;
      $numTravellers = 2;

      $sql = "SELECT * FROM packages where PackageId = " . "'" . $pkgId . "'";
      $result = $database->query($sql);

      # Only one row will be returned
      $row = $result->fetch();
      echo "<b>Package Name: </b>" . $row["PkgName"] . "<br>";
      echo "<b>Description: </b>" . $row["PkgDesc"] . "<br>";
      echo "<b>Start Date: </b>" . $row["PkgStartDate"] . "<br>";
      echo "<b>End Date:&nbsp;&nbsp;&nbsp;</b>" . $row["PkgEndDate"] . "<br>";
      printf("<b>Cost per Person:  $%9.2f</b><br><br>", $row["PkgBasePrice"]);

      # DO I NEED TO ADD COMMISSION TO BASE PRICE??
      printf("<b>TOTAL PRICE:  $%9.2f</b><br><br>", $row["PkgBasePrice"] * $numTravellers);
    ?>

    <div class="card">
      <div class="card-header">
        <h5>Package Booking</h5>
      </div>
      <div class="card-body">
        <p class="card-text"><h6>Please complete this form to make a booking</h6></p>
        <br>

        <form id="customerform" action="processorder.php" method="post">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="fn">First Name<sup>*</sup>&nbsp;<small class="text-muted">&nbsp;Required</small></label>
              <input type="text" class="form-control" id="fn" name="fn">
            </div>
            <div class="form-group col-md-6">
              <label for="ln">Last Name<sup>*</sup></small></label>
              <input type="text" class="form-control" id="ln" name="ln">
            </div>
          </div>
          <div class="form-group">
            <label for="ad">Address</label>
            <input type="text" class="form-control" id="ad" name="ad">
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="ct">City</label>
              <input type="text" class="form-control" id="ct" name="ct">
            </div>
            <div class="form-group col-md-4">
              <label for="pv">Province</label>
              <select id="pv" class="form-control">
                <option selected>Choose Province</option>
                <option>AB</option>
                <option>BC</option>
                <option>MB</option>
                <option>NS</option>
                <option>NB</option>
                <option>NL</option>
                <option>NT</option>
                <option>NU</option>
                <option>ON</option>
                <option>PE</option>
                <option>QC</option>
                <option>SK</option>
                <option>YT</option>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="pc">Postal Code</label>
              <input type="text" class="form-control" id="pc" name="pc">
            </div>
          </div>
          <div class="form-group">
            <label for="cn">Country</label>
            <input type="text" class="form-control" id="cn" name="cn" default="Canada">
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="hp">Home Phone</label>
              <input type="tel" class="form-control" id="hp" name="hp">
            </div>
            <div class="form-group col-md-6">
              <label for="bp">Business Phone</label>
              <input type="tel" class="form-control" id="bp" name="bp">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="em">Email<sup>*</sup></label>
              <input type="email" class="form-control" id="em" name="em">
            </div>
          </div>

          <div class="form-group">
              <input type="submit" name="booktrip" class="btn btn-primary" value="Book Trip">
              <input type="button" class="btn btn-default" value="Cancel" onclick="window.location.href='../index.php'">
            </div>

        </form>

      <!-- Only show the following if user is not logged in -->
      <p>Already have an account? <a href="../../login/index.php">Login here</a>.</p>
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
