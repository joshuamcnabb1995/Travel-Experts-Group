<?php
    function packageStarted($packageStartDate) {
        // If the package start date is less than the current date
        if(strtotime($packageStartDate) < time())
            return TRUE;
    }

    function packageEndingSoon($packageStartDate) {
        $currentDate = time();
        $oneDay = 86400; // One day in seconds

        if(strtotime($packageStartDate) - $oneDay <= $currentDate)
            return TRUE;

        else
            return FALSE;
    }
