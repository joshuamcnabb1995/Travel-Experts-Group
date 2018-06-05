<html>
    <head>
        <title>Contact Form Tutorial by Bootstrapious.com</title>
        <?php include('../inc/css.php'); ?>
        <style>
        .col-8{ background: rgb(29, 198, 193); }
        .col-4{ background-color: rgb(129, 212, 165);}
        </style>
    </head>
    <body>
      <?php include('../inc/navigation.php'); ?>
      <div class="container" style="margin-top:100px;">
      <?php include('../inc/javascript.php'); ?>
      <?php include('../inc/footer.php'); ?>

                    <h1>Contact form</h1>

                    <p class="lead">Please send us a message and one of our agents will get in touch with you as soon as possible.</p>

                    <!-- We're going to place the form here in the next step -->
                    <form id="contact-form" method="post" action="contact.php" role="form">

                    <label for="form_name">Firstname *</label>
                    <input id="form_name" type="text" name="name" class="form-control" placeholder="Please enter your firstname *" required="required" data-error="Firstname is required.">

                    <label for="form_lastname">Lastname *</label>
                    <input id="form_lastname" type="text" name="surname" class="form-control" placeholder="Please enter your lastname *" required="required" data-error="Lastname is required.">

                    <label for="form_email">Email *</label>
                    <input id="form_email" type="email" name="email" class="form-control" placeholder="Please enter your email *" required="required" data-error="Valid email is required.">

                    <label for="form_phone">Phone</label>
                    <input id="form_phone" type="tel" name="phone" class="form-control" placeholder="Please enter your phone">

                    <label for="form_message">Message *</label>
                    <textarea id="form_message" name="message" class="form-control" placeholder="Message for me *" rows="4" required="required" data-error="Please,leave us a message."></textarea></br>
                    <div class="help-block with-errors"></div>

                <input type="submit" class="btn btn-success btn-send" value="Send message">

                <p class="text-muted"><strong>*</strong> These fields are required.</p></br>
                </form>
                <div class="row">
                  <div class="col-8"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d321303.3268281848!2d-114.35433369398585!3d51.01278199569303!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x537170039f843fd5%3A0x266d3bb1b652b63a!2sCalgary%2C+AB!5e0!3m2!1sen!2sca!4v1527883694526" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe></div>
                  <div class="col-4">
                    <pre>
                      <h3>Contact:</h3>
                      travelexpert.Ca
                      Canada Toll-free number: 1.888.289.6660
                      Worldwide Contact: +1.403.289.6656
                      Email: fly@travelexpert.ca

                      <h3>Locations:</h3>

                      Calgary                         Okotoks
                      CANADA WIDE CALL CENTRE
                      Unit B, 916 16th Ave            7th St
                      Calgary, Alberta T2M 0K3        Okotoks, Alberta V1c6M1

                      Hours (Mtn Std time):
                      Mon to Fri : 8am – 6:30pm
                      Sat : 9am – 4pm
                      Sun : 11am – 4pm
                </pre>
                </div>
              </div>
        </body>
</html>