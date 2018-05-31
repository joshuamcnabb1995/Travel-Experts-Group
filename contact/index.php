<html>
    <head>
        <title>Contact Form Tutorial by Bootstrapious.com</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
        <link href='custom.css' rel='stylesheet' type='text/css'>
    </head>
    <body>



                    <h1>Contact</h1>

                    <p class="lead">Please send us a message and one of our agents will get in touch with you as soon as possible.</p>

                    //------------------------------
                    <form id="contact-form" method="post" action="contact.php" role="form">
                      <label for="form_name">Firstname *</label>
                    <input id="form_name" type="text" name="name" class="form-control" placeholder="Please enter your firstname *" required="required" data-error="Firstname is required.">
                    <label for="form_message">Message *</label>
                   <textarea id="form_message" name="message" class="form-control" placeholder="Message for me *" rows="4" required="required" data-error="Please,leave us a message."></textarea>
                   <input type="submit" class="btn btn-success btn-send" value="Send message">
                   <p class="text-muted"><strong>*</strong> These fields are required. Contact form template by <a href="http://bootstrapious.com" target="_blank">Bootstrapious</a>.</p>
                 </form>

                  </body>
</html>
