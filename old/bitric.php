<?
/**
 * Write data to log file.
 *
 * @param mixed $data
 * @param string $title
 *
 * @return bool
 */
function writeToLog($data, $title = 'Annex') {
 $log = "\n------------------------\n";
 $log .= date("Y.m.d G:i:s") . "\n";
 $log .= (strlen($title) > 0 ? $title : 'DEBUG') . "\n";
 $log .= print_r($data, 1);
 $log .= "\n------------------------\n";
 file_put_contents(getcwd() . '/hook.log', $log, FILE_APPEND);
 return true;
}

$defaults = array('first_name' => '', 'last_name' => '', 'phone' => '', 'email' => '');

if (array_key_exists('saved', $_REQUEST)) {
 $defaults = $_REQUEST;
 writeToLog($_REQUEST, 'webform');

 $queryUrl = 'https://b24-2wflsa.bitrix24.com/rest/36/r1xt8w4noop12pup/crm.lead.add.json';
 $queryData = http_build_query(array(
 'fields' => array(
 "TITLE" => $_REQUEST['first_name'].' '.$_REQUEST['last_name'],
 "NAME" => $_REQUEST['first_name'],
 "LAST_NAME" => $_REQUEST['last_name'],
 "STATUS_ID" => "NEW",
 "OPENED" => "Y",
 "ASSIGNED_BY_ID" => 1,
 "PHONE" => array(array("VALUE" => $_REQUEST['phone'], "VALUE_TYPE" => "WORK" )),
 "EMAIL" => array(array("VALUE" => $_REQUEST['email'], "VALUE_TYPE" => "WORK" )),
 ),
 'params' => array("REGISTER_SONET_EVENT" => "Y")
 ));

 $curl = curl_init();
 curl_setopt_array($curl, array(
 CURLOPT_SSL_VERIFYPEER => 0,
 CURLOPT_POST => 1,
 CURLOPT_HEADER => 0,
 CURLOPT_RETURNTRANSFER => 1,
 CURLOPT_URL => $queryUrl,
 CURLOPT_POSTFIELDS => $queryData,
 ));

 $result = curl_exec($curl);
 curl_close($curl);

 $result = json_decode($result, 1);
 writeToLog($result, 'webform result');

 if (array_key_exists('error', $result)) echo "Error saving Lead: ".$result['error_description']."
";
}

?>
<form method="post" action="">
    First name: <input type="text" name="first_name" size="15" value="<?=$defaults['first_name']?>"><br/>
    Last name: <input type="text" name="last_name" size="15" value="<?=$defaults['last_name']?>"><br/>
    Telephone: <input type="phone" name="phone" value="<?=$defaults['phone']?>"<

    E-mail: <input type="email" name="email" value="<?=$defaults['email']?>"><br/>
    <input type="hidden" name="saved" value="yes">
    <input type="submit" value="Send">
</form>


<?

print_r($_REQUEST);
writeToLog($_REQUEST, 'incoming');

/**
 * Write data to log file.
 *
 * @param mixed $data
 * @param string $title
 *
 * @return bool
 */
function writeToLog($data, $title = '') {
 $log = "\n------------------------\n";
 $log .= date("Y.m.d G:i:s") . "\n";
 $log .= (strlen($title) > 0 ? $title : 'DEBUG') . "\n";
 $log .= print_r($data, 1);
 $log .= "\n------------------------\n";
 file_put_contents(getcwd() . '/hook.log', $log, FILE_APPEND);
 return true;
} 
2017.01.17 12:58:29
incoming
Array
(
    [event] => ONCRMDEALUPDATE
    [data] => Array
        (
            [FIELDS] => Array
                (
                    [ID] => 662
                )

        )

    [ts] => xxx
    [auth] => Array
        (
            [domain] => xxx.bitrix24.com
            [client_endpoint] => https://xxx.bitrix24.com/rest/
            [server_endpoint] => https://oauth.bitrix.info/rest/
            [member_id] => xxx
            [application_token] => xxx
        )

)
\Bitrix\Main\Loader::includeModule('rest');

class MyEventProvider extends \Bitrix\Rest\Event\ProviderOAuth
{
   public function send(array $queryData)
   {
      $http = new \Bitrix\Main\Web\HttpClient();
      foreach($queryData as $key => $item)
      {
         if(preg_match('/192\.168\./', $item['query']['QUERY_URL'])) // directly sending handlers, having  192.168. in the address
         {
            $http->post($item['query']['QUERY_URL'], $item['query']['QUERY_DATA']);
            unset($queryData[$key]);
         }
      }

      if(count($queryData) > 0)
      {
         parent::send(array_values($queryData)); // all the rest is to be sent via the standard mechanism
      }
   }
}

\Bitrix\Rest\Event\Sender::setProvider(MyEventProvider::instance());

?>
