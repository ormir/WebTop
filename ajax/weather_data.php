<?php
header('Content-Type: application/json');

if (isset($_POST['cityZIP'])){
	$client = new SoapClient("http://wsf.cdyne.com/WeatherWS/Weather.asmx?WSDL");
	print_r($client);
} else {
	echo '{"success": 0, "message": "hey"}';
}

?>