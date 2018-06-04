<!-- register/index.php
  Travel Experts Group Project
  Corinne Mullan -->

<!DOCTYPE html>
<html>
    <head>
        <title>Travel Experts - Customer Registration</title>

        <?php include('../inc/css.php'); ?>
        <?php include('../inc/javascript.php'); ?>

        <script>

          // Enable and populate the popovers that give hints for each input field
          $(document).ready(function(){
            $('[data-toggle="popover"]').popover();
          });

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
              $('#e1').popover({content: "Please enter your email address", placement: "top", trigger: "focus"});
              $('#e2').popover({content: "Please re-enter your email address", placement: "top", trigger: "focus"});
              $('#id').popover({content: "Please choose a user ID containing only letters and numbers", placement: "top", trigger: "focus"});
              $('#pw').popover({content: "Please choose a password", placement: "top", trigger: "focus"});
          });

          // The validateFormSubmission() function validates the user-entered data before submitting the form
          function validateFormSubmission(form) {

          		/* First confirm the submission with the user.  If the user clicks cancel,
          	  return false to cancel the submission.*/
          		var response = confirm("Are you sure you want to submit this form?");

          		if (!response)
          				return false;

          	  /* If the user wishes to sumbit, proceed to validate the data.  The "required" attribute
          	  has been set on the first name, last name and email input fields, so here we just need to
          		confirm that the two email entries match, confirm that the postal code follows the
          	  correct format, and confirm that the telephone number (if entered) is 10 digits.  */

          		if (form.e1.value != form.e2.value) {
          					alert("The entered emails do not match!");
          					form.e1.focus();
          					return false;
          		}

          		/*  The postal code is of the form XdXdXd where X is any letter (allow upper or lower case
          		and d is any single digit.  The field is only 6 characters long, so we do not need to allow
          		for a space.  The code just checks for the required pattern, and does not check for specific
          		letters that do not appear in valid Canadian postal codes.

          	  The postal code is not a required field, so it can also be empty. */
          		var postalCodePattern = /^[A-Za-z]\d[A-Za-z]\d[A-Za-z]\d$/;
          		if (!postalCodePattern.test(form.pc.value) && form.pc.value != "") {
          					alert("Postal code format is incorrect!");
          					form.pc.focus();
          					return false;
          		}

          		// Verify the phone numbers are either null, or contain 10 digits
          		var telPattern = /^[0-9]{10}$/;
          		if (!telPattern.test(form.hp.value) && form.hp.value != "") {
          			  	alert("Home phone number format is incorrect!");
          					form.hp.focus();
          					return false;
          		}

              if (!telPattern.test(form.bp.value) && form.bp.value != "") {
                    alert("Business phone number format is incorrect!");
                    form.bp.focus();
                    return false;
              }

              // Verify that the user name contains only letters and/or numbers
              var idPattern = /^[A-Za-z0-9]+$/;
              if (!idPattern.test(form.id.value)) {
          			  	alert("User ID format is incorrect!");
          					form.id.focus();
          					return false;
          		}

          		// Otherwise return true to proceed with the submission.
          		return true;
         }
      </script>

    </head>

    <body>
          <?php include('../inc/navigation.php'); ?>

          <div class="container" style="margin-top:80px; margin-bottom:80px;">
            <h4>New Customer Registration</h4>
            <br>

            <form method="post" action="http://localhost/bouncer.php">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="fn">First Name<sup>*</sup>&nbsp;<small class="text-muted">&nbsp;Required</small></label>
                  <input type="text" class="form-control" id="fn" required="required">
                </div>
                <div class="form-group col-md-6">
                  <label for="ln">Last Name<sup>*</sup></small></label>
                  <input type="text" class="form-control" id="ln" required="required">
                </div>
              </div>
              <div class="form-group">
                <label for="ad">Address</label>
                <input type="text" class="form-control" id="ad">
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="ct">City</label>
                  <input type="text" class="form-control" id="ct">
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
                  <input type="text" class="form-control" id="pc">
                </div>
              </div>
              <div class="form-group">
                <label for="cn">Country</label>
                <input type="text" class="form-control" id="cn" default="Canada">
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="hp">Home Phone</label>
                  <input type="tel" class="form-control" id="hp">
                </div>
                <div class="form-group col-md-6">
                  <label for="bp">Business Phone</label>
                  <input type="tel" class="form-control" id="bp">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="e1">Email<sup>*</sup></label>
                  <input type="email" class="form-control" id="e1" required="required">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="e2">Re-enter Email<sup>*</sup></label>
                  <input type="email" class="form-control" id="e2" required="required">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="id">Choose a User ID<sup>*</sup></label>
                  <input type="text" class="form-control" id="id" required="required">
                </div>
                <div class="form-group col-md-6">
                  <label for="pw">Choose a Password<sup>*</sup></label>
                  <input type="text" class="form-control" id="pw" required="required">
                </div>
              </div>

              <br>
              <input type="submit" class="btn btn-primary" value="Submit Form" onclick="return validateFormSubmission(this.form);">
              <input type="reset" class="btn btn-primary" value="Reset Form" onclick="return confirm('Are you sure you want to reset this form?');">

            </form>
          </div>

        <?php include('../inc/footer.php'); ?>
    </body>
</html>
