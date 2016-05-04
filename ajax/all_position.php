<?php 
session_start();
header('Content-Type: application/json');
	
if (isset($_SESSION['username'])) {
	include '../includes/db.php';
	echo json_encode((new WebtopDB())->getAllPositions($_SESSION['username']));
}
?>