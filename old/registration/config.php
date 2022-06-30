<?php
    $con = new mysqli('localhost', 'root', '65eca298d9927ee20303e0349d2c2602e01a4a1e8b411d2f', 'annexis_directory');
    // Check connection
    if ($con ->connect_errno) {
        echo "Failed to connect to MySQL: " . $con -> connect_error;
        exit();
    }
    
    $keyId = 'rzp_live_UNFenz1NyEohrl';
    $keySecret = 'vKCsRvjrO35Zyh2sc7Rt6tI y ';
    $displayCurrency = 'INR';

    //These should be commented out in production
    // This is for error reporting
    // Add it to config.php to report any errors
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
?> 