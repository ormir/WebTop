<?php
session_start();
header('Content-Type: application/json');
include "../includes/db.php";

if (isset($_POST['addNewRss'])){
	echo json_encode((new WebtopDB)->addRss($_POST['addNewRss']['title'], 
								$_POST['addNewRss']['link'],
								$_POST['addNewRss']['description'],
								$_POST['addNewRss']['date']));
} else if (isset($_POST['getAllRss'])) {
	echo json_encode((new WebtopDB)->getAllRss());
} else if (isset($_POST['rss_edit'])) {
	echo json_encode((new WebtopDB)->editRss($_POST['rss_edit']));
} else if (isset($_POST['rss_delete'])) {
	echo json_encode((new WebtopDB)->deleteRss($_POST['rss_delete']));
}

?>