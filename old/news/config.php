<?php
$host     = "localhost"; // Database Host
$user     = "root"; // Database Username
$password = "65eca298d9927ee20303e0349d2c2602e01a4a1e8b411d2f"; // Database's user Password
$database = "annexis_blog"; // Database Name 

$connect = new mysqli($host, $user, $password, $database);

// Checking Connection
if (mysqli_connect_errno()) {
    printf("Database connection failed: %s\n", mysqli_connect_error());
    exit();
}

mysqli_set_charset($connect, "utf8");

$site_url       = "https://annextrades.com/news";
?>