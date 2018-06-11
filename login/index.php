<?php
    include('../inc/global.php');

    $page = 4;
    $emailError = (isset($_SESSION['emailError_login']) ? $_SESSION['emailError_login'] : NULL);
    $passwordError = (isset($_SESSION['passwordError_login']) ? $_SESSION['passwordError_login'] : NULL);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
          <?php include('../inc/css.php'); ?>
        <style type="text/css">
            body{ font: 14px sans-serif; }
            .wrapper{ width: 350px; padding: 20px; }

            /* Corinne */
            .error { color: red !important; margin-top: 6px !important; }
            /* Corinne */

            /* Joshua */
            font[color='red'] {font-weight: bold; }
            label { font-weight: bold; }
            /* Joshua */

        </style>
    </head>
    <body>

      <?php include('../inc/navigation.php'); ?>

      <div class="container" style="margin-top:80px; margin-bottom:80px;">
        <div class="card">
          <div class="card-header">
            <h5>Login</h5>
          </div>
          <div class="card-body">
            <p>Please fill in your credentials to login.</p>
            <form action="processLogin.php" method="post">
                <div class="form-group">
                    <label>Email <font color="red">*</font></label>
                    <input type="text" name="email" class="form-control"<?php if(isset($_SESSION['login_email'])) echo ' value="' . $_SESSION['login_email'] . '"'; ?> />
                    <span class="help-block error"><?php echo (isset($emailError)) ? $emailError : ''; ?></span>
                </div>
                <div class="form-group">
                    <label>Password <font color="red">*</font></label>
                    <input type="password" name="password" class="form-control"<?php if(isset($_SESSION['login_password'])) echo ' value="' . $_SESSION['login_password'] . '"'; ?> />
                    <span class="help-block error"><?php echo (isset($passwordError)) ? $passwordError : ''; ?></span>
                </div>
                <div class="form-group"><input type="submit" class="btn btn-primary" value="Login"></div>
                <p>Don't have an account? <a href="../register/index.php">Sign up now</a>.</p>
            </form>
          </div>
        </div>
    </div>
    <?php include('../inc/javascript.php'); ?>
    <?php include('../inc/footer.php'); ?>
    </body>
</html>
<?php session_unset(); ?>
