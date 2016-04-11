<?php 
session_start();
header('Content-Type: application/json');

if (isset($_POST['element'])){
	$element = $_POST['element'];
	$_SESSION['elements'][$element['id']] = ['top' => $element['top'], 'left' => $element['left']];
	echo json_encode($_SESSION['elements']);
}
?>