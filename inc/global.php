<?php
    session_start();

    include('database.php');
    include('functions.php');

    /* Disable cache temporarily */
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    /* Disable cache temporarily */

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
