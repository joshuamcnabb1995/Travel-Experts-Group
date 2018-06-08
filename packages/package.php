<?php
    $page = 2;
    include('../inc/global.php');

    $getPackage = $database->query("SELECT * FROM packages WHERE PackageId = '" . $_GET['id'] . "'");
    $package = $getPackage->fetch();
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
            <?php if(packageEndingSoon($package['PkgEndDate'])) echo '<div id="packageWarning" class="notice notice-warning"><strong>Notice:</strong>&nbsp; Package ending soon!</div>'; ?>
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
                            <div class="col"><i class="fa fa-calendar"></i> Started: <?php echo date('Y-m-d', strtotime($package['PkgStartDate'])); ?></div>
                            <div class="col<?php if(packageEndingSoon($package['PkgEndDate'])) echo ' expiring'; ?>"><i class="fa fa-calendar"></i> Ends:
                            <?php
                                $packageDate = date('Y-m-d', strtotime($package['PkgEndDate'])); // Display only the date
                                $packageTime = date('g:ia', strtotime($package['PkgEndDate'])); // Display only the time

                                if(packageEndingSoon($package['PkgEndDate'])) {
                                    if($packageDate = date('Y-m-d')) echo 'Today at ' . $packageTime;

                                    else echo 'Tomorrow at ' . $packageTime;
                                }

                                else echo $packageDate;
                            ?>
                            </div>
                        </div>
                        <h5 class="price">current price: <s>$5200.00</s> <span>$<?php echo number_format($package['PkgBasePrice'], 2, '.', ''); ?></span></h5>
                        <form id="quantity">
                            Quantity:<br />
                            <input class="form-control" type="number" name="quantity" step="1" min=1 max=10 value=0 >
                            <input type="hidden" name="packageId" value="<?php echo $package['PackageId']; ?>" />
                        </form>
                        <div class="action"><button class="add-to-cart btn btn-success" type="button'"><i class="fa fa-cart-plus"></i>&nbsp; Book Destination</button></div>
					</div>
				</div>
			</div>
		</div>
        </div>

        <?php include('../inc/javascript.php'); ?>
        <?php include('../inc/footer.php'); ?>
    </body>
</html>
