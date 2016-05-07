<?php 
session_start();
header('Content-Type: application/json');
// include '../includes/db.php';

if (isset($_POST['element'])){
	include '../includes/db.php';
	(new WebtopDB)->savePosition($_POST['element'], $_SESSION['username']);
}

?> 