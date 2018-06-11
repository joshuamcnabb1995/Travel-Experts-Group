<?php
    $page = 1;

    include('inc/global.php');
    include('./inc/classes/Customer.php');

    if(isset($_COOKIE['uid']))
        $Customer = new Customer($_COOKIE['uid']);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Travel Experts - The Best Travel Site on the Web!</title>
        <?php include('inc/css.php'); ?>
    </head>

    <body>
        <?php include('inc/navigation.php'); ?>
        <?php include('inc/header.php'); ?>

        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading" style="margin-bottom:15px;"><?php echo (isset($_COOKIE['uid']) ? 'Welcome back, ' . $Customer->getInfo('CustFirstName') : 'Welcome to Travel Experts'); ?></h1>
                <?php echo (isset($_COOKIE['uid']) ? '' : '<p class="lead text-muted">We may be a small company, but we have large ideas when it comes to travel, specifically how we can save you time and money.</p>'); ?>
                <p>
                    <?php
                        if(isset($_COOKIE['uid']))
                            echo '<a href="packages" class="btn btn-success"><i class="fa fa-plane"></i>&nbsp; Start Browsing Packages</a>';

                        else
                            echo '<a href="#" class="btn btn-primary my-2"><i class="fa fa-info-circle"></i>&nbsp; Find Out More</a> &nbsp; <a href="register" class="btn btn-success my-2"><i class="fa fa-user-plus"></i>&nbsp; Create a Free Account</a>';
                    ?>
                </p>
            </div>
        </section>

        <?php
        if(isset($_COOKIE['uid'])) {
        ?>
        <section>
            <div class="container">
                <?php
                $Customer = new Customer($_COOKIE['uid']);

                /*
                    Ideally you would get this information from the bookings, bookingdetails and triptypes
                    tables, but we did not have enough time to add rows to those tables when the customer
                    placed an order for a package
                */
                $getBookings = $database->prepare("SELECT PkgName, PkgStartDate, PkgEndDate, PkgDesc, PkgBasePrice, BookingDate, BookingNo, TravelerCount
                                                  FROM packages, bookings
                                                  WHERE CustomerId = ?
                                                  AND bookings.PackageId = packages.packageId
                                                  ORDER BY PkgStartDate");
                $getBookings->execute([$Customer->getInfo('CustomerId')]);

                if($getBookings->rowCount() == 0)
                    echo '<h4 style="margin-bottom:25px;text-align:center;">No bookings yet.</h4>';

                else {
                ?>
                <h4>Recent Bookings (<a href="#">View All</a>)</h4>
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Booking #</th>
                            <th scope="col">Booking Date</th>
                            <th scope="col">Package Name</th>
                            <th scope="col">Base Price</th>
                            <th scope="col">Travelers</th>
                            <th scope="col">Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($getBookings->fetchAll() as $booking) {
                                echo '<tr>
                                    <th scope="row">' . $booking['BookingNo'] . '</th>
                                    <td>' . date('l, F n, Y \a\t h:iA', strtotime($booking['BookingDate'])) . '</td>
                                    <td>' . $booking['PkgName'] . '</td>
                                    <td><b>$' . number_format($booking['PkgBasePrice'], 2, '.', '') . '</b></td>
                                    <td>' . $booking['TravelerCount'] . '</td>
                                    <td><span style="color:green;font-weight:bold;">$' . number_format($booking['PkgBasePrice'] * $booking['TravelerCount'], 2, '.', '') . '</span></td>
                                </tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
        <?php
        }

        else {
        ?>
    	<section id="what-we-do">
    		<div class="container-fluid">
    			<h2 class="section-title mb-2 h1">What we do</h2>
    			<p class="text-center text-muted h5">Having and managing a correct marketing strategy is crucial in a fast moving market.</p>
    			<div class="row mt-5">
    				<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
    					<div class="card">
    						<div class="card-block block-1">
    							<h3 class="card-title">Special title</h3>
    							<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
    							<a href="javascript:void();" title="Read more" class="read-more" >Read more<i class="fa fa-angle-double-right ml-2"></i></a>
    						</div>
    					</div>
    				</div>
    				<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
    					<div class="card">
    						<div class="card-block block-2">
    							<h3 class="card-title">Special title</h3>
    							<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
    							<a href="javascript:void();" title="Read more" class="read-more" >Read more<i class="fa fa-angle-double-right ml-2"></i></a>
    						</div>
    					</div>
    				</div>
    				<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
    					<div class="card">
    						<div class="card-block block-3">
    							<h3 class="card-title">Special title</h3>
    							<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
    							<a href="javascript:void();" title="Read more" class="read-more" >Read more<i class="fa fa-angle-double-right ml-2"></i></a>
    						</div>
    					</div>
    				</div>
    			</div>
    			<div class="row">
    				<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
    					<div class="card">
    						<div class="card-block block-4">
    							<h3 class="card-title">Special title</h3>
    							<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
    							<a href="javascript:void();" title="Read more" class="read-more" >Read more<i class="fa fa-angle-double-right ml-2"></i></a>
    						</div>
    					</div>
    				</div>
    				<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
    					<div class="card">
    						<div class="card-block block-5">
    							<h3 class="card-title">Special title</h3>
    							<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
    							<a href="javascript:void();" title="Read more" class="read-more" >Read more<i class="fa fa-angle-double-right ml-2"></i></a>
    						</div>
    					</div>
    				</div>
    				<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
    					<div class="card">
    						<div class="card-block block-6">
    							<h3 class="card-title">Special title</h3>
    							<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
    							<a href="javascript:void();" title="Read more" class="read-more" >Read more<i class="fa fa-angle-double-right ml-2"></i></a>
    						</div>
    					</div>
    				</div>
    			</div>
    		</div>
    	</section>
        <?php } ?>

        <?php include('inc/javascript.php'); ?>
        <?php include('inc/footer.php'); ?>
    </body>
</html>
