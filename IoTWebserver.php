<?php
require_once "lib/nusoap.php";
$server= new nusoap_server();
$server->configureWSDL("IoT-RaspberryPi","urn:IoT");
$server->wsdl->addComplexType("ArrayOfString", 
                 "complexType", 
                 "array", 
                 "", 
                 "SOAP-ENC:Array", 
                 array(), 
                 array(array("ref"=>"SOAP-ENC:arrayType","wsdl:arrayType"=>"xsd:string[]")), 
                 "xsd:string"); 
$data = array(
            'temp'=>'xsd:string',
            'humid'=>'xsd:string',
            'timestamp' => 'xsd:string'
            );
$server->register(
         	'receiveData',
         	$data,
        	array('return'=>'xsd:string')
    		);
$server->register("showtable",
                array("keyword" => "xsd:string"),
                array("return" =>  "tns:ArrayOfString")
                );
function receiveData($temp,$humid,$timestamp){
    $file = 'temp.xml';
    $xml = simplexml_load_file($file);
    $data = $xml->addChild('Temp_Humid');
    $data->addChild('temp', $temp);
    $data->addChild('humid', $humid); 
    $data->addChild('timestamp', $timestamp);   
    $xml->asXML($file); 
    return "receive Success!";
}
function showtable($keyword){
	$xml = simplexml_load_file('temp.xml');
    $result = array();
    foreach ($xml->Temp_Humid as $data) {
    	array_push($result,$data->temp,$data->humid,$data->timestamp);
    }
    return $result;
}
$rawPostData = file_get_contents("php://input"); 
$server->service($rawPostData);


