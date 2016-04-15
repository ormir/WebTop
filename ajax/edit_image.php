<?php 
header('Content-Type: application/json');

if (isset($_POST['image'])){
	imagesrc = $_POST['image']['src'];
	if (isset($_POST['image']['src'])){
		echo "src ".$_POST['image']['src'];
	} else {
		echo "missing src";
	}

	if (isset($_POST['image']['edit'])){
		echo "edit ".$_POST['image']['edit'];
	} else {
		echo "missing edit";
	}
}
?>