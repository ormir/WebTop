<?php
header('Content-Type: application/json');

if (isset($_POST['cityZIP'])){
	$client = new SoapClient("http://wsf.cdyne.com/WeatherWS/Weather.asmx?WSDL");
	$result=$client->GetCityWeatherByZIP(array("ZIP"=>$_POST['cityZIP']));
	$result= $result["GetCityWeatherByZIP"];
} else {
	echo '{"success": 0, "message": "hey"}';
}

?>