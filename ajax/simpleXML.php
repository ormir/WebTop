<?php

// echo $html;
session_start();
header('Content-Type: application/json');
include "../includes/db.php";

$filename = 'ajax/simpleXML.xml';

$data=(new WebtopDB)->getAllRss();
// print_r($data);
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

if (isset($_POST['addNewRss'])){
	// initializing or creating array
	$data = array((new WebtopDB)->addRss($_POST['addNewRss']['title'], 
								$_POST['addNewRss']['link'],
								$_POST['addNewRss']['description'],
								$_POST['addNewRss']['date']));
}

// creating object of SimpleXMLElement
$xml_data = new SimpleXMLElement('<?xml version="1.0"?><data></data>');

// function call to convert array to xml
array_to_xml($data,$xml_data);

//saving generated xml file; 
// $result = $xml_data->asXML('../ajax/simpleXML.xml');
$result = $xml_data->asXML('../'.$filename);

if ($result) {
    echo '{"success" : 1, "filename" : "'.$filename.'"}';
} else {
    echo '{"success" : 0}';
}

?>