<?php 
header('Content-Type: application/json');

if (isset($_POST['image'])){
	$imagesrc = $_POST['image']['src'];
	$edit = $_POST['image']['edit'];
	$editsuccess = false;

	if (!empty($imagesrc) && !empty($edit)){
		$imagesrc = "../".$imagesrc;
		// echo "src: ".$imagesrc." edit: ".$edit;

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
			echo "{success}";
		} else {
			echo "Edit fail: ".$edit." on ".$imagesrc;
		}

	} else if (empty($imagesrc)) {
		echo "missing src";
	} else if (empty($edit)) {
		echo "missing edit";
	}
}
// imagedestroy($image);

?>