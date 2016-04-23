<?php
session_start();
header('Content-Type: application/json');

if (isset($_POST['changes'])){
	include "../includes/db.php";

	$set = "";

	// Organise changes for query
	foreach ($_POST['changes'] as $colum => $value) {
		$set = $set.$colum."='".$value."', ";
	}

	// Remove last comma
	$set = substr($set, 0, -2);

	$sql = "UPDATE user SET ".$set." WHERE username = '".$_SESSION['username']."'";
	// echo $sql."||";

	if ($mysqli->query($sql) === TRUE) {
	    echo '{"success": 1}';
	} else {
	    echo '{"success":0, "message":"Error updating record: '.$conn->error.'"}';
	}
	$mysqli->close();
} else {
	echo '{"success":0, "message":"No changes found"}';
}
?>