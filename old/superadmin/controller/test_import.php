<?php

//exit('ok');
include_once '../../controller/config.php';
    $lot = 'Lot_58K_16_10_21';
    $lotQuery = "SELECT * FROM whatsapp_tem_add ORDER BY id ASC";
    $lotResult = $conn->query($lotQuery);
    $i = '1';
            while($row = mysqli_fetch_array($lotResult)){
                // Get row data
                $phone  = $row['phone'];
                echo $phone.' - ';
                $data = array (
                    'blocking' => 'wait',
                    'force_check' => true,
                    'contacts' => 
                    array (
                      0 => '+'.$phone,
                    ),
                  );
                $json = json_encode($data); // Encode data to JSON
                // URL for request POST /message 
                //echo $json;
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
                $res_data = json_decode($result, 1); // Parse JSON
                
                $result = $res_data['contacts'][0];
                
                echo $result['status'].' - '.$i.'<br>'; 
                $status = $result['status'];
                
                $conn->query("INSERT INTO whatsapp (`phonenumber`, `lot`, `status`) VALUES ('".$phone."', '$lot', '$status')");
                    $i++;
            }
            
            $qstring = '?status=succ';
       
            echo $qstring;

// Redirect to the listing page
//header("Location: ../import_contact.php".$qstring);