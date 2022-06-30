< ?php
// Load the database configuration file
include_once '../controller/config.php';

if(isset($_POST['importSubmit'])){
    
    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
            
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                $phone  = $line[0];

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
                    //echo "Sender:".$message['author']."<br>";
                    //echo "Message: ".$message['body']."<br>";
                }
                echo $data['author'].'\n';


                // Check whether member already exists in the database with the same email
                $prevQuery = "SELECT id FROM whatsapp WHERE phonenumber = '".$line[0]."'";
                $prevResult = $conn->query($prevQuery);
                
                if($prevResult->num_rows > 0){
                    // Update member data in the database
                    //$conn->query("UPDATE whatsapp SET name = '".$name."', phone = '".$phone."', status = '".$status."', modified = NOW() WHERE email = '".$email."'");
                    $conn->query("UPDATE whatsapp SET phonenumber = '".$phone."' WHERE phonenumber = '".$line[0]."'");
                }else{
                    // Insert member data in the database
                    //$conn->query("INSERT INTO whatsapp (name, email, phone, created, modified, status) VALUES ('".$name."', '".$email."', '".$phone."', NOW(), NOW(), '".$status."')");
                    $conn->query("INSERT INTO whatsapp (phonenumber) VALUES ('".$phone."')");
                }
            }
            
            // Close opened CSV file
            fclose($csvFile);
            
            $qstring = '?status=succ';
        }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }
}

// Redirect to the listing page
//header("Location: import.php".$qstring);