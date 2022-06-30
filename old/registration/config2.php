
<?php
 
 
 $conn = new mysqli('annextrades.com', 'root' , 'Annexis@123', 'annexis_directory');
 
 var_dump($conn);
 // Check connection
 if ($conn -> connect_errno) {
     echo "Failed to connect to MySQL: " . $conn -> connect_error;
     exit();
    }
echo '1';
while($q = mysqli_fetch_array($conn, "Select * From registration ")){
    
    echo $q['vendor_id'];

}

?>