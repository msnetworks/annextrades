<?php
//Proxy Protection
$table = $prefix . 'proxy-settings';
$query = $mysqli->query("SELECT * FROM `$table`");
$row   = $query->fetch_assoc();

//Method 1
if ($row['protection'] > 0) {
    
    $proxyv = 0;
    
    if ($row['protection'] == 1) {
        
        $key = $row['api1'];
        
        $ch    = curl_init();
        $url   = 'http://v2.api.iphub.info/ip/' . $ip . '';
        curl_setopt_array($ch, [
			CURLOPT_URL => $url,
			CURLOPT_CONNECTTIMEOUT => 30,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_HTTPHEADER => [ "X-Key: {$key}" ]
        ]);
        $block = json_decode(curl_exec($ch))->block;
        curl_close($ch);
        
        if ($block) {
            $proxyv = 1;
        }
        
    } else if ($row['protection'] == 2) {
        
        $key = $row['api2'];
        
        $ch           = curl_init('http://proxycheck.io/v2/' . $ip . '?key=' . $key . '&vpn=1');
        $curl_options = array(
            CURLOPT_CONNECTTIMEOUT => 30,
            CURLOPT_RETURNTRANSFER => true
        );
        curl_setopt_array($ch, $curl_options);
        $response = curl_exec($ch);
        curl_close($ch);
        $jsonc = json_decode($response);
        
        if (isset($jsonc->$ip->proxy) && $jsonc->$ip->proxy == "yes") {
            $proxyv = 1;
        }
        
    } else if ($row['protection'] == 3) {
        
		$key = $row['api3'];
		
        $headers = [
			'X-Key: '.$key,
        ];
        $ch = curl_init("https://www.iphunter.info:8082/v1/ip/" . $ip);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        $output      = json_decode(curl_exec($ch), 1);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($http_status == 200) {
            if ($output['data']['block'] == 1) {
                $proxyv = 1;
            }
        }
        
    }
    
    if ($proxyv == 1) {
        
        $type = "Proxy";
        
        //Logging
        if ($row['logging'] == 1) {
            psec_logging($mysqli, $prefix, $type);
        }
        
        //AutoBan
        if ($row['autoban'] == 1) {
            psec_autoban($mysqli, $prefix, $type);
        }
        
        //E-Mail Notification
        if ($srow['mail_notifications'] == 1 && $row['mail'] == 1) {
            psec_mail($mysqli, $prefix, $site_url, $projectsecurity_path, $type, $srow['email']);
        }

        echo '<meta http-equiv="refresh" content="0;url=' . $row['redirect'] . '" />';
        exit;
    }
}

//Method 2
if ($row['protection2'] == 1) {
    $proxy_headers = array(
        'HTTP_VIA',
        'HTTP_X_FORWARDED_FOR',
        'HTTP_FORWARDED_FOR',
        'HTTP_X_FORWARDED',
        'HTTP_X_FORWARDED_HOST',
        'HTTP_FORWARDED',
        'HTTP_FORWARDED_FOR_IP',
        'HTTP_FORWARDED_PROTO',
        'HTTP_PROXY_CONNECTION'
    );
    foreach ($proxy_headers as $x) {
        if (isset($_SERVER[$x])) {
            
            $type = "Proxy";
            
            //Logging
            if ($row['logging'] == 1) {
                psec_logging($mysqli, $prefix, $type);
            }
            
            //AutoBan
            if ($row['autoban'] == 1) {
                psec_autoban($mysqli, $prefix, $type);
            }
            
            //E-Mail Notification
            if ($srow['mail_notifications'] == 1 && $row['mail'] == 1) {
                psec_mail($mysqli, $prefix, $site_url, $projectsecurity_path, $type, $srow['email']);
            }
            
            echo '<meta http-equiv="refresh" content="0;url=' . $row['redirect'] . '" />';
            exit;
        }
    }
}

//Method 3
if ($row['protection3'] == 1) {
    $ports = array(
        8080,
        80,
        1080,
        3128,
        4145,
        32231,
        53281
    );
    foreach ($ports as $port) {
        if (@fsockopen($ip, $port, $errno, $errstr, 30)) {
            
            $type = "Proxy";
            
            //Logging
            if ($row['logging'] == 1) {
                psec_logging($mysqli, $prefix, $type);
            }
            
            //AutoBan
            if ($row['autoban'] == 1) {
                psec_autoban($mysqli, $prefix, $type);
            }
            
            //E-Mail Notification
            if ($srow['mail_notifications'] == 1 && $row['mail'] == 1) {
                psec_mail($mysqli, $prefix, $site_url, $projectsecurity_path, $type, $srow['email']);
            }
            
            echo '<meta http-equiv="refresh" content="0;url=' . $row['redirect'] . '" />';
            exit;
        }
    }
}
?>