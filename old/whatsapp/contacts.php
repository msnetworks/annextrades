<?php 
    $data = array (
        'blocking' => 'wait',
        'force_check' => true,
        'contacts' => 
        array (
          0 => '+918082698952',
          1 => '+919055509190',
          2 => '+917006422684',
        ),
      );
    $json = json_encode($data); // Encode data to JSON
    // URL for request POST /message
    echo $json;
    $token = 'off_aeO3laRMD21N1vjB9aCtwAS7AK';
    $instanceId = '343954';

    $url = 'https://api.chat-api.com/instance'.$instanceId.'/contacts?token='.$token;
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
    foreach($data['message'] as $message){ // Echo every message
        echo "Sender:".$message['author']."<br>";
        echo "Message: ".$message['body']."<br>";
    }
    echo $result;
    //echo "<script>window.location.href='index.php?msg=success'</script>";
?>