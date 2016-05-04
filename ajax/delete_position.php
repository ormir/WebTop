<?php 
session_start();
header('Content-Type: application/json');
include "../includes/db.php";

if (isset($_POST['elementid']) &&
	!(new WebtopDB)->deletePosition($_POST['elementid'], $_SESSION['username']))
	echo "Element ".$element['id']." couldn't be deleted";
?>