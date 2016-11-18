<?php
require_once("lib/nusoap.php");
$client = new nusoap_client("http://localhost/IoT/IoTWebserver.php?wsdl");
$result = $client->call("showtable",array("keyword" => "ALL"));
$index = 0;
$outputjson[0] = array('Timestamp','Temperature','Humidity');
$Temp;
$Humid;
$Timestamp;
$num_data = 1;
foreach ($result as $key => $value) {
      switch ($index) {
        case 0:
          $Temp = $value;
          $index = $index+1;
          break;
        case 1:
          $Humid = $value;
          $index = $index+1;
          break;
        case 2:
          $Timestamp = $value;	
          $index = $index+1;
          break;
      }
      if(($key+1) %3 ==0 ){
          $index = 0;
          $outputjson[$num_data] = array((string)substr($Timestamp, 0,20),(int)$Temp,(int)$Humid);
          $num_data +=1;
      }
    }     
echo json_encode($outputjson);

?>