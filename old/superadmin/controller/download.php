<?php
include "../../controller/config.php";
$filename = 'registration_'.time().'.csv';

// POST values
$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];

// Select query
$query = "SELECT * FROM registration ORDER BY id asc";

if(isset($_POST['from_date']) && isset($_POST['to_date'])){
   $query = "SELECT * FROM registration where added_date between '".$from_date."' and '".$to_date."' ORDER BY id asc";
}

$result = mysqli_query($conn,$query);
$employee_arr = array();

// file creation
$file = fopen($filename,"w");

// Header row - Remove this code if you don't want a header row in the export file.
$employee_arr = array("ID","First Name","Last Name", "Company Name","Phone Number","Email"); 

while($row = mysqli_fetch_assoc($result)){
   $id = $row['id'];
   $first_name = $row['firstname'];
   $last_name = $row['lastname'];
   $companyname = $row['companyname'];
   $phonenumber = $row['phonenumber'];
   $email = $row['email'];

   // Write to file 
   $employee_arr = array($id,$first_name,$last_name,$salary,$companyname,$phonenumber,$email);
   fputcsv($file,$employee_arr); 
}

fclose($file);

// download
header("Content-Description: File Transfer");
header("Content-Disposition: attachment; filename=$filename");
header("Content-Type: application/csv; ");

readfile($filename);

// deleting file
unlink($filename);
exit();
?>