<?php 
session_start();
header('Content-Type: application/json');

if (isset($_POST['elementid'])) {
	unset($_SESSION['elements'][$_POST['elementid']]);
}
?>