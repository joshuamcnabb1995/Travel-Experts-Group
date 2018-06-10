
<!-- Student Name: S-Sara  Nejad-Hashemi -->

<html>
    <head>
        <title>Contact Form</title>
        <?php include('../inc/css.php'); ?>
        <style>
          .col-5{ background:rgb(208, 242, 233); }
          .col{ background-color: rgb(123, 223, 184);}
          .col-6{background:rgb(143, 222, 240);}
        </style>
    </head>
    <body>
        <?php include('../inc/navigation.php'); ?>
        <div class="container" style="margin-top:150px;margin-bottom:100px">
          <?php include('../inc/javascript.php'); ?>
          <?php include('../inc/footer.php'); ?>
                <div class="container">
                  <div class="row">
                    <div class="col-5">
                      <h1>Contact form</h1>
                        <p class="lead">Please send us a message and one of our agents will get back to you as soon as possible.</p>

                              <!---contact form-->
                              <form id="contact-form" method="post" action="contact.php" role="form">

                                  <label for="form_name">Firstname *</label>
                                  <input id="fname" type="text" name="fname" class="form-control" placeholder="Please enter your firstname *" required="required" data-error="Firstname is required.">
                                  <label for="form_lastname">Lastname *</label>
                                  <input id="surname" type="text" name="surname" class="form-control" placeholder="Please enter your lastname *" required="required" data-error="Lastname is required.">
                                  <label for="form_email">Email *</label>
                                  <input id="email" type="email" name="email" class="form-control" placeholder="Please enter your email *" required="required" data-error="Valid email is required.">
                                  <label for="form_phone">Phone * (xxx.xxx.xxxx)</label>
                                  <input id="phone" type="tel" name="phone" class="form-control" placeholder="Please enter your phone" pattern="^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$">
                                  <label for="form_message">Message *</label>
                                  <textarea id="message" name="message" class="form-control" placeholder="Message for me *" rows="4" required="required" data-error="Please,leave us a message."></textarea></br>
                                  <div class="help-block with-errors"></div>
                                  <input type="submit" class="btn btn-success btn-send" value="Send message">
                                  <p class="text-muted"><strong>*</strong> These fields are required.</p></br>
                              </form>
                        </div>

                        <!---the map-->
                        <div class="col"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2508.3847274439972!2d-114.09056018453519!3d51.04598357956202!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x53716fe76e972489%3A0x149461cedf5b7c5b!2s1155+8+Ave+SW%2C+Calgary%2C+AB!5e0!3m2!1sen!2sca!4v1528609261988" width="350" height="550" frameborder="0" style="border:0" allowfullscreen></iframe></div>

                        <div class="col">
                        <!---Agencies contact info-->
                            <?php
                              include('../inc/database.php');
                              $sql = $database->query("SELECT AgencyId, AgncyAddress, AgncyProv, AgncyCity, AgncyPostal, AgncyCountry, AgncyPhone,AgncyFax  FROM agencies");
                              echo "<br><i><h4>Office Locations:</h4></i>";
                              foreach($sql as $row) {
                                echo "<br><h5>".$row["AgncyCity"]."</h5></br>Address: ".$row["AgncyAddress"]."</br>Postalcode: ".$row["AgncyPostal"]."</br>Phone: ".$row["AgncyPhone"]."</br>Fax: ".$row["AgncyFax"]."</br>E-mail: info@travelexpert.com</br> ";
                                }
                            ?>
                      </div>
                      </div>

                      <div class="row">
                        <div class="col-6">
                          <!-- Agents Contact info -->
                          <?php
                            include('../inc/database.php');
                            $sql = $database->query("SELECT AgtFirstName, AgtMiddleInitial, AgtLastName, AgtBusPhone, AgtEmail  FROM agents WHERE AgencyId=1");
                            echo "<br><i><h5> Calgary Office:<h5></i>";
                            foreach($sql as $row) {
                              echo "<br><h6>".$row["AgtFirstName"]." ".$row["AgtMiddleInitial"]." ".$row["AgtLastName"]."</h6></b>Phone: ".$row["AgtBusPhone"]."</br>E-Mail: ".$row["AgtEmail"]."</br>";
                              }
                          ?>
                        </div>

                        <div class="col-6">
                          <!-- Agents Contact info -->
                          <?php
                            include('../inc/database.php');
                            $sql = $database->query("SELECT AgtFirstName, AgtMiddleInitial, AgtLastName, AgtBusPhone, AgtEmail  FROM agents WHERE AgencyId=2 ");
                            echo "<br><i><h5> Okotoks Office:<h5></i>";
                            foreach($sql as $row) {
                              echo "<br><h6>".$row["AgtFirstName"]." ".$row["AgtMiddleInitial"]." ".$row["AgtLastName"]."</h6></b>Phone: ".$row["AgtBusPhone"]."</br>E-Mail: ".$row["AgtEmail"]."</br>";

                              }
                          ?>
                      </div>
                    </div>
                  </div>

        </body>
</html>
