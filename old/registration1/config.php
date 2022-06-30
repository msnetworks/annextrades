<?php
    $con = new mysqli('localhost', 'root', '65eca298d9927ee20303e0349d2c2602e01a4a1e8b411d2f', 'annexis_directory');
    // Check connection
    if ($con ->connect_errno) {
        echo "Failed to connect to MySQL: " . $con -> connect_error;
        exit();
    }
?>