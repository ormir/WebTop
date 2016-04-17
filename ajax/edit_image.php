<?php 
header('Content-Type: application/json');

if (isset($_POST['image'])){
	$imagesrc = $_POST['image']['src'];
	$edit = $_POST['image']['edit'];
	$editsuccess = false;

	if (!empty($imagesrc) && !empty($edit)){
		$imagesrc = "../".$imagesrc;

		// Create new image
		$image = imagecreatefromjpeg($imagesrc);

		// Edit image
		switch($edit) {
			case "mirror":
				$editsuccess = imageflip($image, IMG_FLIP_BOTH);
				break;

			case "greyscale":
				$editsuccess = imagefilter($image, IMG_FILTER_GRAYSCALE);
				break;

			case "rotate_clockwise":
				$rotate = imagerotate($image, 270, 0);
				$image = $rotate;
				$editsuccess = $rotate;
				break;

			case "rotate_anticlockwise":
				$rotate = imagerotate($image, 90, 0);
				$image = $rotate;
				$editsuccess = $rotate;
				break;

			default:
				echo "Edit ".$edit." not recognised";
		}

		if ($editsuccess) {
			// Save new image
			imagejpeg($image, $imagesrc);
			

			// Send success
			echo "{success: 1}";
		} else {
			echo "{[success: 0, message: 'Edit fail: $edit on $imagesrc'}";
		}

		// Free image memory
		imagedestroy($image);
	} else if (empty($imagesrc)) {
		echo "{success: 0, message: 'missing image source'}";
	} else if (empty($edit)) {
		echo "{success: 0, message: 'missing edit mode'}";
	}
}
<<<<<<< Updated upstream
// 
=======


>>>>>>> Stashed changes
?>