<?php
$host     = "localhost"; // Database Host
$user     = "root"; // Database Username
$password = "65eca298d9927ee20303e0349d2c2602e01a4a1e8b411d2f"; // Database's user Password
$database = "security"; // Database Name
$prefix   = ""; // Database Prefix for the script tables

$mysqli = new mysqli($host, $user, $password, $database);

// Checking Connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

$mysqli->set_charset("utf8");

$site_url             = "https://www.annextrades.com";
$projectsecurity_path = "https://www.annextrades.com";
?>
