<?php
    $page = 1;

    include('inc/global.php');
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
                <h1 class="jumbotron-heading">Welcome to Travel Experts</h1>
                <p class="lead text-muted">We may be a small company, but we have large ideas when it comes to travel, specifically how we can save you time and money.</p>
                <p>
                    <a href="#" class="btn btn-primary my-2"><i class="fa fa-info-circle"></i>&nbsp; Find Out More</a>
                    <a href="#" class="btn btn-success my-2"><i class="fa fa-user-plus"></i>&nbsp; Create a Free Account</a>
                </p>
            </div>
        </section>

        <!--<div class="album py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                            <img class="card-img-top" style="height: 225px; width: 100%; display: block;" src="img/packages/package1.jpg" data-holder-rendered="true">
                            <div class="card-body">
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis...</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-primary">View More &nbsp;<i class="fa fa-chevron-circle-right"></i></button>
                                        <button type="button" class="btn btn-sm btn-outline-success">Book This Destination &nbsp;<i class="fa fa-cart-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                            <img class="card-img-top" style="height: 225px; width: 100%; display: block;" src="img/packages/package2.jpg" data-holder-rendered="true">
                            <div class="card-body">
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis...</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-primary">View More &nbsp;<i class="fa fa-chevron-circle-right"></i></button>
                                        <button type="button" class="btn btn-sm btn-outline-success">Book This Destination &nbsp;<i class="fa fa-cart-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                            <img class="card-img-top" style="height: 225px; width: 100%; display: block;" src="img/packages/package3.jpg" data-holder-rendered="true">
                            <div class="card-body">
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis...</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-primary">View More &nbsp;<i class="fa fa-chevron-circle-right"></i></button>
                                        <button type="button" class="btn btn-sm btn-outline-success">Book This Destination &nbsp;<i class="fa fa-cart-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                            <img class="card-img-top" style="height: 225px; width: 100%; display: block;" src="img/packages/package1.jpg" data-holder-rendered="true">
                            <div class="card-body">
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis...</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-primary">View More &nbsp;<i class="fa fa-chevron-circle-right"></i></button>
                                        <button type="button" class="btn btn-sm btn-outline-success">Book This Destination &nbsp;<i class="fa fa-cart-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                            <img class="card-img-top" style="height: 225px; width: 100%; display: block;" src="img/packages/package2.jpg" data-holder-rendered="true">
                            <div class="card-body">
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis...</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-primary">View More &nbsp;<i class="fa fa-chevron-circle-right"></i></button>
                                        <button type="button" class="btn btn-sm btn-outline-success">Book This Destination &nbsp;<i class="fa fa-cart-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                            <img class="card-img-top" style="height: 225px; width: 100%; display: block;" src="img/packages/package3.jpg" data-holder-rendered="true">
                            <div class="card-body">
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis...</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-primary">View More &nbsp;<i class="fa fa-chevron-circle-right"></i></button>
                                        <button type="button" class="btn btn-sm btn-outline-success">Book This Destination &nbsp;<i class="fa fa-cart-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->

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

        <?php include('inc/javascript.php'); ?>
        <?php include('inc/footer.php'); ?>
    </body>
</html>
