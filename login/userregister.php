<!--
  Author: Safiq Momin
  Date of creation: 06-01-2018
  description: The file contains html code for registration and php code to verify different conditions of the fields relating the database
-->

<!--
   Modified by:  Corinne Mullan
   Date:  06-02-2018
   Description:  Modified client-side validation to use jQuery-validation.
                 Added input field hints using popovers.
                 Modified formatting to use a Bootstrap "card" layout.
-->

<?php
    $page = 4;
    include('../inc/global.php');
?>

<?php
// Include config file
require_once 'config.php';
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            // Set parameters
            $param_username = trim($_POST["username"]);
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        // Closing the statement
        mysqli_stmt_close($stmt);
    }
    // Validating the password
    if(empty(trim($_POST['password']))){
        $password_err = "Please enter a password.";
    } elseif(strlen(trim($_POST['password'])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST['password']);
    }
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = 'Please confirm password.';
    } else{
        $confirm_password = trim($_POST['confirm_password']);
        if($password != $confirm_password){
            $confirm_password_err = 'Password did not match.';
        }
    }
    // Checking input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            // Attempting to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirecting to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
        // Closing statement
        mysqli_stmt_close($stmt);
    }
    // Closing connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <?php include('../inc/css.php'); ?>
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>

<body>

  <?php include('../inc/navigation.php'); ?>

  <div class="container" style="margin-top:80px; margin-bottom:80px;">
    <div class="card">
      <div class="card-header">
        <h5>Sign Up</h5>
      </div>
      <div class="card-body">
        <p class="card-text"><h6>Please fill in this form to create an account</h6></p>
        <br>

        <form id="customerform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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

          <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
              <label>Username<sup>*</sup></label>
              <input type="text" name="username"class="form-control" value="<?php echo $username; ?>" required="required">
              <span class="help-block"><?php echo $username_err; ?></span>
          </div>
          <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
              <label>Password<sup>*</sup></label>
              <input type="password" name="password" class="form-control" value="<?php echo $password; ?>" required="required">
              <span class="help-block"><?php echo $password_err; ?></span>
            </div>
          <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
              <label>Confirm Password<sup>*</sup></label>
              <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>" required="required">
              <span class="help-block"><?php echo $confirm_password_err; ?></span>
          </div>
          <div class="form-group">
              <input type="submit" class="btn btn-primary" value="Submit">
              <input type="reset" class="btn btn-default" value="Reset">
            </div>
        </form>
      </div>

      <p>Already have an account? <a href="login.php">Login here</a>.</p>

  </div>
</div>

<?php include('../inc/javascript.php'); ?>

<script>

  $(document).ready(function(){
      $('#fn').popover({content: "Please enter your first name", placement: "top", trigger: "focus"});
      $('#ln').popover({content: "Please enter your last name", placement: "top", trigger: "focus"});
      $('#ad').popover({content: "Please enter your address", placement: "top", trigger: "focus"});
      $('#ct').popover({content: "Please enter your city", placement: "top", trigger: "focus"});
      $('#pv').popover({content: "Please select your province", placement: "bottom", trigger: "focus"});
      $('#pc').popover({content: "Please enter your postal code as A1A1A1", placement: "top", trigger: "focus"});
      $('#cn').popover({content: "Please enter your country", placement: "top", trigger: "focus"});
      $('#hp').popover({content: "Please enter your home phone number as a 10 digit number", placement: "top", trigger: "focus"});
      $('#bp').popover({content: "Please enter your business phone number as a 10 digit number", placement: "top", trigger: "focus"});
      $('#em').popover({content: "Please enter your email address", placement: "top", trigger: "focus"});
      $('#id').popover({content: "Please choose a user ID containing only letters and numbers", placement: "top", trigger: "focus"});
      $('#p1').popover({content: "Please choose a password", placement: "top", trigger: "focus"});
      $('#p2').popover({content: "Please re-enter the password", placement: "top", trigger: "focus"});

      $.validator.methods.postalcode = function( value, element ) {
          return this.optional( element ) || /^[A-Za-z]\d[A-Za-z]\d[A-Za-z]\d$/.test( value );
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
            postalcode: "Postal code should be in the form A1A1A1"
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

  <?php include('../inc/footer.php'); ?>

</body>
</html>
