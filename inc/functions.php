<?php
    function packageEndingSoon($packageEndDate)
    {
        $currentDate = time();
        $oneDay = 86400; // One day in seconds

        if(strtotime($packageEndDate) - $oneDay <= $currentDate)
            return TRUE;

        else
            return FALSE;
    }
