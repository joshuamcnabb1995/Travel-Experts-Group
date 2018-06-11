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
                                $packages = $database->query("SELECT * FROM packages WHERE PkgEndDate >= '$currentDate' ORDER BY PackageId");

                                if($packages->rowCount() == 0)
                                    echo '<h5 style="margin:6px 6px 12px 12px;">No packages yet. Please check back later.</h5>';

                                else {
                                    foreach($packages as $row) {
                                ?>
                                <div class="col-md-4">
                                    <div class="card mb-4 box-shadow">
                                        <a href="package.php?id=<?php echo $row['PackageId']; ?>"><img class="card-img-top" style="height: 225px; width: 100%; display: block;" src="../img/packages/package<?php echo $row['PackageId']; ?>.jpg" data-holder-rendered="true"></a>
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $row['PkgName']; ?></h5>
                                            <p class="card-text"><?php echo $row['PkgDesc']; ?></p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="window.location.href='package.php?id=<?php echo $row['PackageId']; ?>'">View More &nbsp;<i class="fa fa-chevron-circle-right"></i></button>
                                                    <button type="button" class="btn btn-sm btn-outline-success">Book This Destination &nbsp;<i class="fa fa-cart-plus"></i></button>
                                                </div>
                                            </div>
                                            <?php if(packageEndingSoon($row['PkgStartDate'])) echo '<div style="margin-top:10px;margin-bottom:-10px;font-weight:bold;color:red;">Ending soon...</div>'; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                }
                            }
                            ?>
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
