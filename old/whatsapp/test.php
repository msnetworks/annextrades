<?php

$url = "https://waba-sandbox.360dialog.io/v1/messages";

$payload = <<<'PAYLOAD'
    {
        "to": "919055509190",
        "type": "text",
        "text": {
        	"body": "START"
        }
    }
PAYLOAD;

$headers = [
    "Content-Type: application/json",
    "D360-Api-Key: 09WgN0_sandbox",
];

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $payload,
    CURLOPT_HTTPHEADER => $headers,
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "curl error: " . $err;
} else {
    echo $response;
}

?>