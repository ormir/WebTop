<?php
header('Content-Type: application/json');

$response = array();
//bearbeitet response und schickt ihn weg danach
if (isset($_POST['cityZIP'])){
	$client = new SoapClient("http://wsf.cdyne.com/WeatherWS/Weather.asmx?WSDL");
	$result=$client->GetCityWeatherByZIP(array("ZIP"=>$_POST['cityZIP']));
	$result= $result->GetCityWeatherByZIPResult;
	$response["success"] = 1;
	$response["message"] = $result;
} else {
	$response["success"] = 0;
	$response ["message"] = "Missing Zip";
	// is the same as -> echo '{"success": 0, "message": "hey"}';
}

echo json_encode($response);

?>