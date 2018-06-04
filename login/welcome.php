<?php
// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <?php include('../inc/css.php'); ?>
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
  <!--code to display the Welcome message for the user after log in-->
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION['username']); ?></b>
          <?php
            $t = date("H") - 8;
            if ($t < "12") {
              echo "Have a good morning!";
            } elseif ($t < "16") {
              echo "Have a good afternoon!";
            } else {
              echo "Have a good evening!";
            }
          ?>
        </h1>
    </div>
	<p><a href="config.php" class="btn btn-danger">Add Agent</a></p>
    <p><a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a></p>
</body>
</html>
