<?php
    $page = 2;
    include('../inc/global.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Travel Experts - Available Packages</title>
        <?php include('../inc/css.php'); ?>
    </head>

    <body>
        <?php include('../inc/navigation.php'); ?>

        <div id="packagesContainer" class="container">
            <div id="availablePackages" class="card">
                <div class="card-header"><h5>Available Packages</h5></div>
                <div class="album py-5">
                    <div class="container">
                        <div class="row">
                        <?php
                            $currentDate = date('Y-m-d h:i:s');
                            $packages = $database->query("SELECT * FROM packages WHERE PkgEndDate > '$currentDate' ORDER BY PackageId");

                            foreach($packages as $result) {
                            ?>
                            <div class="col-md-4">
                                <div class="card mb-4 box-shadow">
                                    <a href="package.php?id=1"><img class="card-img-top" style="height: 225px; width: 100%; display: block;" src="../img/packages/package1.jpg" data-holder-rendered="true"></a>
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
                        <?php
                            }
                        ?>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card mb-4 box-shadow">
                                    <a href="package.php?id=1"><img class="card-img-top" style="height: 225px; width: 100%; display: block;" src="../img/packages/package1.jpg" data-holder-rendered="true"></a>
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
                                    <a href="package.php?id=1"><img class="card-img-top" style="height: 225px; width: 100%; display: block;" src="../img/packages/package2.jpg" data-holder-rendered="true"></a>
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
                                    <a href="package.php?id=1"><img class="card-img-top" style="height: 225px; width: 100%; display: block;" src="../img/packages/package3.jpg" data-holder-rendered="true"></a>
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
                                    <a href="package.php?id=1"><img class="card-img-top" style="height: 225px; width: 100%; display: block;" src="../img/packages/package1.jpg" data-holder-rendered="true"></a>
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
                                    <a href="package.php?id=1"><img class="card-img-top" style="height: 225px; width: 100%; display: block;" src="../img/packages/package2.jpg" data-holder-rendered="true"></a>
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
                                    <a href="package.php?id=1"><img class="card-img-top" style="height: 225px; width: 100%; display: block;" src="../img/packages/package3.jpg" data-holder-rendered="true"></a>
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
                </div>

                <div class="card-footer">
                    <nav aria-label="...">
                        <ul class="pagination">
                            <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">Previous</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1 <span class="sr-only">(current)</span></a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <?php include('../inc/javascript.php'); ?>
        <?php include('../inc/footer.php'); ?>
    </body>
</html>
