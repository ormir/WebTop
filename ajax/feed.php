<?php
session_start();
header('Content-Type: application/json');
include "../includes/db.php";

if (isset($_POST['feed_read'])){
	// echo '{"succes" : 1, "message" : "Read feed from: '.$_POST['feed_read'].'"}';
	$myXML = simplexml_load_file($_POST['feed_read']);

	$responce = array();
	$responce['success'] = 1;
	foreach($myXML->entry as $myEntry){
		$responce['feed']["f".$myEntry->id] = ['id' => $myEntry->id->__toString(), 
										'title' => $myEntry->title[0]->__toString(), 
										'link' => $myEntry->id->__toString(),
										'description' => $myEntry->summary->__toString(),
										'date' => $myEntry->published->__toString()];
	}

	echo json_encode($responce);
} else {
	echo '{"succes" : 0, "message" : "No feed found"}';
}

?>