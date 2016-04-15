<?php 
header('Content-Type: application/json');

if (isset($_POST['image'])){
	$imagesrc = $_POST['image']['src'];
	$edit = $_POST['image']['edit'];

	if (!empty($imagesrc) && !empty($edit)){
		$imagesrc = "../".$imagesrc;
		echo "src: ".$imagesrc." edit: ".$edit;

		// Create new image
		$image = imagecreatefromjpeg($imagesrc);

		// Edit image
		switch($edit) {
			case "mirror":
				imagefilter($image, IMG_FLIP_BOTH, NULL);
				break;

			case "greyscale":
				imagefilter($image, IMG_FILTER_GRAYSCALE);
				break;

			case "rotate_clockwise":
				$rotate = imgrotate($source, 270);
				break;
			case "rotate_anticlockwise":
				$rotate = imgrotate($source, 90);
				
			default:
				echo "Edit ".$edit." not recognised";
		}

		// Save new image
		imagejpeg($image, $imagesrc);

		// Send success
		echo "{success}";

	} else if (empty($imagesrc)) {
		echo "missing src";
	} else if (empty($edit)) {
		echo "missing edit";
	}
}
// imagedestroy($image);

?>