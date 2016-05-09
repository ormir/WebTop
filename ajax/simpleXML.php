<?php
// $html = " ";

// //variable that stores the value of the url that is the data feed whatever website happens to have running
// $url= "http://starwars.wikia.com/wiki/Yoda/api/v1/Articles/Details/?ids=50&abstract=100&width=200&height=200)";

// echo $url;

// //returns xml object 
// $xml = simplexml_load_file($url);

// //choosing how many items (lines) we want, thus we need a loop - in our case: 10 lines
// for ($i = 0; $i < 10; $i++){


// }
// echo $html;
session_start();
header('Content-Type: application/json');
include "../includes/db.php";
$data=(new WebtopDB)->getAllRss();
print_r($data);
// function defination to convert array to xml
function array_to_xml( $data, &$xml_data ) {
    foreach( $data as $key => $value ) {
        if( is_array($value) ) {
            if( is_numeric($key) ){
                $key = 'item'.$key; //dealing with <0/>..<n/> issues
            }
            $subnode = $xml_data->addChild($key);
            array_to_xml($value, $subnode);
        } else {
            $xml_data->addChild("$key",htmlspecialchars("$value"));
        }
     }
}

// initializing or creating array
$data = array('rssfeed' => 10);

// creating object of SimpleXMLElement
$xml_data = new SimpleXMLElement('<?xml version="1.0"?><data></data>');

// function call to convert array to xml
array_to_xml($data,$xml_data);

//saving generated xml file; 
$result = $xml_data->asXML('../ajax/simpleXML.xml');

?>