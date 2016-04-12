<?php 
header('Content-Type: application/json');

if (isset($_POST['path'])) {
	$filepath = "../".$_POST['path'];
	if(!unlink($filepath)){
		echo "Could not delete file ".$filepath;
	}
} else {
	echo $_POST['path'];
}
?>