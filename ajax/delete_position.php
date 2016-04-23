<?php 
session_start();
header('Content-Type: application/json');

if (isset($_POST['elementid'])) {
	include "../includes/db.php";
	$sql = "UPDATE user_app SET status = 0 WHERE id="
		."(SELECT id FROM apps WHERE name = '".$_POST['elementid']."')";

	if($mysqli->query($sql) !== TRUE){
		echo "Element ".$element['id']." couldn't be deleted";
	}
}
?>