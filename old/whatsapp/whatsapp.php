< ?php

//$number = $_POST['phone'];

$msg = $_POST['message'];

include('../controller/config.php');

 $query = $conn->query("SELECT * FROM whatsapp ORDER BY id ASC LIMIT 4");
 
 WHILE($row=mysqli_fetch_array($query)){
    $number = $row['phonenumber'];
    $data = array (
        'template' => $msg,
        'language' => 
        array (
          'policy' => 'deterministic',
          'code' => 'en',
        ),
        'namespace' => 'e7315ae0_3a17_4a05_bfa5_eb70a886abcf',
        'chatId' => $number.'@c.us',
        'phone' => $number,
    );
    $json = json_encode($data); // Encode data to JSON
    // URL for request POST /message
    $token = 'off_aeO3laRMD21N1vjB9aCtwAS7AK';
    $instanceId = '343954';

    $url = 'https://api.chat-api.com/instance'.$instanceId.'/sendTemplate?token='.$token;
    // Make a POST request
    $options = stream_context_create(['http' => [
        'method'  => 'POST',
        'header'  => 'Content-type: application/json',
        'content' => $json
        ]
    ]);
    // Send a request
    $result = file_get_contents($url, false, $options);
    $data = json_decode($result, 1); // Parse JSON
    /* foreach($data['response'] as $message){ // Echo every message
        //echo "Sender:".$message['author']."<br>";
        echo "Message: ".$message->message."<br>";
    } */
    $data = $data['response'];
    $status = $data['message'];
    echo $data['message'].'<br>';
    $conn->query("INSERT INTO whatsapp_report (`phone`, `status`, `message_id`) VALUE ('$number', '$status', '$msg')");
}
//echo "<script>window.location.href='index.php?msg=success'</script>";
?>