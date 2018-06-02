<!-- register/index.php
  Travel Experts Group Project
  Corinne Mullan -->
  <?php
      $page = 4;
      include('../inc/global.php');
  ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Travel Experts - Customer Registration</title>
        <?php include('../inc/css.php'); ?>
    </head>

    <body>
          <?php include('../inc/navigation.php'); ?>

          <div class="container" style="margin-top:80px; margin-bottom:80px;">
            <div class="card">
              <div class="card-header">
                <h5>New Customer Registration</h5>
              </div>
              <div class="card-body">
                <p class="card-text"><h6>Please enter your information below</h6></p>
                <br>

                <form id="customerform" method="post" action="http://localhost/bouncer.php">
                  <div class="form-row">
                      <div class="form-group col-md-6">
                          <label for="fn">First Name<sup>*</sup>&nbsp;<small class="text-muted">&nbsp;Required</small></label>
                          <input type="text" class="form-control" id="fn" name="fn" data-toggle="popover">
                      </div>
                      <div class="form-group col-md-6">
                          <label for="ln">Last Name<sup>*</sup></small></label>
                          <input type="text" class="form-control" id="ln" name="ln" data-toggle="popover">
                      </div>
                  </div>
                  <div class="form-group">
                    <label for="ad">Address</label>
                    <input type="text" class="form-control" id="ad" name="ad" data-toggle="popover">
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="ct">City</label>
                      <input type="text" class="form-control" id="ct" name="ct" data-toggle="popover">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="pv">Province</label>
                      <select id="pv" name="pv" class="form-control" data-toggle="popover">
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
                      <input type="text" class="form-control" id="pc" name="pc" data-toggle="popover">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="cn">Country</label>
                    <input type="text" class="form-control" id="cn" name="cn" data-toggle="popover" default="Canada">
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="hp">Home Phone</label>
                      <input type="tel" class="form-control" id="hp" name="hp" data-toggle="popover">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="bp">Business Phone</label>
                      <input type="tel" class="form-control" id="bp" name="bp" data-toggle="popover">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="em">Email<sup>*</sup></label>
                      <input type="email" class="form-control" id="em" name="em" data-toggle="popover">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="id">Choose a User ID<sup>*</sup></label>
                      <input type="text" class="form-control" id="id" name="id" data-toggle="popover">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="p1">Choose a Password<sup>*</sup></label>
                      <input type="password" class="form-control" id="p1" name="p1" data-toggle="popover">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="p2">Re-enter Password<sup>*</sup></label>
                      <input type="password" class="form-control" id="p2" name="p2" data-toggle="popover">
                    </div>
                  </div>

                  <br>

                  <input id="submit" class="btn btn-primary" type="submit" value="Submit Form">
                  <input type="reset" class="btn btn-primary" value="Reset Form" onclick="return confirm('Are you sure you want to reset this form?');">

                </form>
              </div>
            </div>

            <br>
            <p>Already a member?&emsp;<a href="/travel-experts-group/packages/login/" class="btn btn-primary">Login</a></p>
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
                    },
                    id: {
                      required: true
                    },
                    p1: {
                      required: true
                    },
                    p2: {
                      required: true
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
