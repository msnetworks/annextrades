<?php
########## MySql details (Replace with yours) #############
$username = "root"; //mysql username
$password = ""; //mysql password
$hostname = "localhost"; //hostname
$databasename = 'b2b_new'; //databasename

$connecDB = mysqli_connect("localhost", "root", "")or die('could not connect to database');
mysqli_select_db('b2b_new',$connecDB)or die("connection error");

?>