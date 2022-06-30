<?php 

include('config.php');

//if (isset($_REQUEST['submit_quote'])) { 

$product_id = $_POST['product_id'];
$sender_vendor_id = $_REQUEST['sender_vendor_id'];  // Get Email Value
$reply_vendor_id = $_REQUEST['reply_vendor_id'];  // Get Email Value
$message = $_REQUEST['message']; // Get Message Value
$rec_vendor_id = $_POST['rec_vendor_id']; 

$qury = $conn->query("INSERT INTO getquote SET sender_vendor_id = '$sender_vendor_id', rec_vendor_id = '$rec_vendor_id', reply_by = '$reply_vendor_id', product_id = '$product_id', quote = '$message', status = '1' ");
/*  echo $conn->error;
 var_dump($qury); */
 if ($qury) {

     $q = $conn->query("SELECT * FROM getquote order by id desc limit 1 ");
        $r = mysqli_fetch_array($q);
        $date = $r['date'];
        $quote = $r['quote']; 
        $response = array("date" => $date, "quote" => $quote, "reply_by" => $reply_vendor_id);
    
        echo json_encode($response);

    //echo "<SCRIPT>location.href='../reply.php?id=$product_id&s_id=$rec_vendor_id'</SCRIPT>";    
} 

// } 

?>