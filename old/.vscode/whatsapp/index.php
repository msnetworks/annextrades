<?php
$data = [
    'phone' => '8492800628', // Receivers phone
    'body' => 'Hello, MyWorld!', // Message
];
$json = json_encode($data); // Encode data to JSON
// URL for request POST /message
$token = 'fj3sakzjuk4a7ujy';
$instanceId = '341696';
$url = 'https://api.chat-api.com/instance'.$instanceId.'/message?token='.$token;
// Make a POST request
$options = stream_context_create(['http' => [
        'method'  => 'POST',
        'header'  => 'Content-type: application/json',
        'content' => $json
    ]
]);
// Send a request
$result = file_get_contents($url, false, $options);
?>