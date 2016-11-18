<?php 
require("lib/nusoap.php");
$client = new nusoap_client("http://localhost/IoT/IoTWebserver.php?wsdl",true); 
$add = array(
        'temp' => "30",
        'humid' => "33",
        'timestamp' => "test"
	);
$data = $client->call("receiveData",$add);		
echo $data;
echo '<h2>Request</h2><pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
echo '<h2>Response</h2><pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->getDebug(), ENT_QUOTES) . '</pre>';
?>

<?xml version="1.0" encoding="ISO-8859-1"?>
	<SOAP-ENV:Envelope SOAP-ENV:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/">
		<SOAP-ENV:Body>
			<receiveData>
				<temp xsi:type="xsd:string">30</temp>
				<humid xsi:type="xsd:string">33</humid>
				<timestamp xsi:type="xsd:string">test</timestamp>
			</receiveData>
		</SOAP-ENV:Body>
	</SOAP-ENV:Envelope>