<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-primary">
    <a class="navbar-brand" href="#">Travel Experts</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item<?php if($page == 1) echo ' active'; ?>"><a class="nav-link" href="<?php if(!$page == 1) echo '#'; else echo '/travel-experts-group'; ?>">Home<?php if($page == 1) echo ' <span class="sr-only">(current)</span>'; ?></a></li>
            <li class="nav-item<?php if($page == 2) echo ' active'; ?>"><a class="nav-link" href="<?php if(!$page == 2) echo '#'; else echo '/travel-experts-group/packages'; ?>">Vacation Packages<?php if($page == 2) echo ' <span class="sr-only">(current)</span>'; ?></a></li>
            <li class="nav-item<?php if($page == 3) echo ' active'; ?>"><a class="nav-link" href="<?php if(!$page == 3) echo '#'; else echo '/travel-experts-group/contact'; ?>">Contact Us</a></li>
        </ul>
        <?php if(!isset($_COOKIE['uid'])) { ?>
        <ul class="navbar-nav">
            <li class="nav-item<?php if($page == 4) echo ' active'; ?>"><a class="nav-link" href="<?php if(!$page == 4) echo '#'; else echo '/travel-experts-group/login'; ?>">Login</a></li>
            <li class="nav-item<?php if($page == 5) echo ' active'; ?>"><a class="nav-link" href="<?php if(!$page == 5) echo '#'; else echo '/travel-experts-group/register'; ?>">Register</a></li>
        </ul>
        <?php } ?>
    </div>
</nav>
