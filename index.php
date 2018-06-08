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
                <h1 class="jumbotron-heading"><?php echo (isset($_COOKIE['uid']) ? 'Welcome back, ' . $Customer->getInfo('CustFirstName') : 'Welcome to Travel Experts'); ?></h1>
                <?php echo (isset($_COOKIE['uid']) ? '' : '<p class="lead text-muted">We may be a small company, but we have large ideas when it comes to travel, specifically how we can save you time and money.</p>'); ?>
                <p>
                    <?php
                        if(isset($_COOKIE['uid']))
                            echo '<a href="#" class="btn btn-success"><i class="fa fa-user-circle"></i>&nbsp; View Account</a> &nbsp; <a href="#" class="btn btn-secondary"><i class="fa fa-sign-out"></i>&nbsp; Logout</a>';

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
                <h4>Recent Bookings</h4>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Booking #</th>
                            <th scope="col">Booking Date</th>
                            <th scope="col">Destination</th>
                            <th scope="col">Trip Type</th>
                            <th scope="col">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <a href="#">
                            <tr>
                                <th scope="row">WDR898</th>
                                <td>June 8th, 2018</td>
                                <td>Vancouver</td>
                                <td>Business</td>
                                <td><span style="color:green;font-weight:bold;">$450.00</span></td>
                            </tr>
                        </a>

                        <tr>
                            <th scope="row">1ZVSMY</th>
                            <td>June 8th, 2018</td>
                            <td>Vancouver</td>
                            <td>Business</td>
                            <td><span style="color:green;font-weight:bold;">$450.00</span></td>
                        </tr>

                        <tr>
                            <th scope="row">ZMRIIW</th>
                            <td>June 8th, 2018</td>
                            <td>Vancouver</td>
                            <td>Business</td>
                            <td><span style="color:green;font-weight:bold;">$450.00</span></td>
                        </tr>

                        <tr>
                            <th scope="row">LC6GJ8</th>
                            <td>June 8th, 2018</td>
                            <td>Vancouver</td>
                            <td>Business</td>
                            <td><span style="color:green;font-weight:bold;">$450.00</span></td>
                        </tr>

                        <tr>
                            <th scope="row">1EZD4S</th>
                            <td>June 8th, 2018</td>
                            <td>Vancouver</td>
                            <td>Business</td>
                            <td><span style="color:green;font-weight:bold;">$450.00</span></td>
                        </tr>
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
