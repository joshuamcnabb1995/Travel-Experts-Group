<?php
    $page = 2;
    include('../inc/global.php');
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
            <div id="package" class="card">
			<div class="container-fliud">
				<div class="wrapper row">
					<div class="preview col-md-6">

						<div class="preview-pic tab-content">
						  <img src="../img/packages/package1.jpg">
						</div>
					</div>
					<div class="details col-md-6">
						<h3 class="product-title">Carribean New Year</h3>
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
						<p class="product-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        <div id="dates" class="row">
                            <div class="col"><i class="fa fa-calendar"></i> Start: Today at 3:00PM</div>
                            <div class="col"><i class="fa fa-calendar"></i> End: Tomorrow at 3:00PM</div>
                        </div>
                        <h5 class="price">current price: <s>$5200</s> <span>$4800</span></h5>
						<div class="action"><button class="add-to-cart btn btn-success" type="button"><i class="fa fa-cart-plus"></i>&nbsp; Book Destination</button></div>
					</div>
				</div>
			</div>
		</div>
        </div>

        <?php include('../inc/javascript.php'); ?>
        <?php include('../inc/footer.php'); ?>
    </body>
</html>
