<?php
session_start();
header('Content-Type: application/json');

if (isset($_POST['changes'])){
	include "../includes/db.php";
	echo (new WebtopDB())->editProfile($_POST['changes'], $_SESSION['username']);
} else {
	echo '{"success":0, "message":"No changes found"}';
}
?>