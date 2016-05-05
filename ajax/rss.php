<?php
session_start();
header('Content-Type: application/json');
include "../includes/db.php";

if (isset($_POST['addNewRss'])){
	if((new WebtopDB)->addRss($_POST['addNewRss']['title'], 
								$_POST['addNewRss']['link'],
								$_POST['addNewRss']['description'],
								$_POST['addNewRss']['date'])) {

		echo '{"success":1, "message":"Rss succefully added"}';	
	} else {
		echo '{"success":0, "message":"Failed to add rss"}';	
	}
} else if (isset($_POST['getAllRss'])) {
	echo json_encode((new WebtopDB)->getAllRss());
} else if (isset($_POST['rss_edit'])) {
	echo json_encode((new WebtopDB)->editRss($_POST['rss_edit']));
} else if (isset($_POST['rss_delete'])) {
	echo json_encode((new WebtopDB)->deleteRss($_POST['rss_delete']));
}
?>