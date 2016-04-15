<?php 
header('Content-Type: application/json');

if (isset($_POST['image'])){
	$imagesrc = $_POST['image']['src'];
	$edit = $_POST['image']['edit'];

	if (!empty($imagesrc) && !empty($edit)){
		echo "src: ".$imagesrc." edit: ".$edit;

		// Create new image
		
		// Edit image
		
		// Save new image
		
		// Send success
		

	} else if (empty($imagesrc)) {
		echo "missing src";
	} else if (empty($edit)) {
		echo "missing edit";
	}
}
?>