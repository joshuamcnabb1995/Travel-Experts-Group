<?php
    $page = 2;
    include('../inc/global.php');
    include('../inc/classes/Customer.php');

    if(isset($_COOKIE['uid']))
        $Customer = new Customer($_COOKIE['uid']);

    $getPackage = $database->query("SELECT * FROM packages WHERE PackageId = '" . $_GET['id'] . "'");
    $package = $getPackage->fetch();

    $packageStartDate = date('Y-m-d', strtotime($package['PkgStartDate'])); // Display only the date
    $packageStartTime = date('g:iA', strtotime($package['PkgStartDate'])); // Display only the time

    if(packageStarted($package['PkgStartDate'])) {
        if($packageStartDate = date('Y-m-d')) $packageStartText = 'Today at ' . $packageStartTime;

        else $packageStartText = 'Tomorrow at ' . $packageStartTime;
    }

    $packageStartText = $packageStartDate;

    $packageEndDate = date('Y-m-d', strtotime($package['PkgEndDate'])); // Display only the date
    $packageEndTime = date('g:iA', strtotime($package['PkgEndDate'])); // Display only the time

    if(packageEndingSoon($package['PkgEndDate'])) {
        if($packageEndDate = date('Y-m-d')) $packageEndText = 'Today at ' . $packageEndTime;

        else $packageEndText = 'Tomorrow at ' . $packageEndTime;
    }

    else $packageEndText = $packageEndDate;

    // If the customer is logged in
    if(isset($_COOKIE['uid'])) {
        $getBookings = $database->prepare("SELECT BookingId FROM bookings WHERE PackageId = ? AND CustomerId = ?");
        $getBookings->execute([$package['PackageId'], $Customer->getInfo('CustomerId')]);

        if($getBookings->rowCount() > 0)
            $packageBooked = TRUE;

        else
            $packageBooked = FALSE;
    }

    $_SESSION['id'] = $package['PackageId']; // Package id
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Travel Experts - Package 1</title>
        <?php include('../inc/css.php'); ?>
        <link rel="stylesheet" href="packages.css" />
    </head>

    <body>
        <?php include('../inc/navigation.php'); ?>

        <div class="container">
            <?php
                if(packageEndingSoon($package['PkgStartDate']))
                    echo '<div id="packageWarning" class="notice notice-warning"><strong>Notice:</strong>&nbsp; Package availability ending soon!</div>';

                if(isset($_SESSION['ordererror'])) echo '<div id="packageWarning" class="notice notice-danger"><strong>Error:</strong>&nbsp; You cannot order this package a second time.</div>';
            ?>
            <div id="package" class="card">
			<div class="container-fliud">
				<div class="wrapper row">
					<div class="preview col-md-6">

						<div class="preview-pic tab-content">
						  <img src="../img/packages/package<?php echo $package['PackageId']; ?>.jpg">
						</div>
					</div>
					<div class="details col-md-6">
						<h3 class="product-title"><?php echo $package['PkgName']; ?></h3>
						<div class="rating">
							<div class="stars">
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star"></span>
							</div>
							<span class="review-no">41 reviews</span>
						</div>
						<p class="product-description"><?php echo $package['PkgDesc']; ?></p>
                        <div id="dates" class="row">
                            <div class="col<?php echo (packageStarted($package['PkgStartDate']) ? ' expiring' : ''); ?>">
                                <i class="fa fa-calendar"></i> Starts: <?php echo $packageStartText; ?>
                            </div>
                            <div class="col">
                                <i class="fa fa-calendar"></i> Ends: <?php echo $packageEndText; ?>
                            </div>
                        </div>
                        <h5 class="price">current price: <span>$<?php echo number_format($package['PkgBasePrice'], 2, '.', ''); ?></span></h5>
                        <form id="quantity" action="order/index.php" method="POST">
                            Number of Travelers:<br />
                            <input class="form-control" type="number" name="quantity" step="1" min=1 max=10 value=1 >

                            <?php if(isset($packageBooked) && !$packageBooked) { ?>
                            <input class="btn btn-success" type="submit" value="Book Destination" style="margin-top:10px;" />
                        <?php } else if(!isset($packageBooked)) {
                        ?>
                        <input class="btn btn-success" type="submit" value="Login to Book Destination" style="margin-top:10px;" disabled />
                        <?php
                        } else { ?>
                                <input class="btn btn-success" type="submit" value="Destination Already Booked" style="margin-top:10px;" disabled />
                            <?php } ?>
                        </form>
					</div>
				</div>
			</div>
		</div>
        </div>

        <?php include('../inc/javascript.php'); ?>
        <?php include('../inc/footer.php'); ?>
    </body>
</html>
<?php unset($_SESSION['ordererror']); ?>
