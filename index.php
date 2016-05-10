<?php 
session_start();

include "includes/db.php";

$login = false;
$db = new WebtopDB();

// Register User
if (isset($_POST['submit-register'])) {
	
	// Pic upload
	$fileupload = array();
	$fileupload['new_name'] = 'NULL';

	if (isset($_FILES['register_pic']) && 
		$_FILES['register_pic']['error'] == 0 &&
		$_FILES['register_pic']['size']>0 &&
		$_FILES['register_pic']['tmp_name'] &&
		is_uploaded_file($_FILES['register_pic']['tmp_name'])) { 
                 
	   $fileupload=$_FILES['register_pic'];
	   $tmp_explode = explode('.', $fileupload['name']);
	   $file_ext = strtolower(end($tmp_explode));
	   $fileupload['new_name'] = md5($_POST['username']+time()).".".$file_ext;
	   $fileupload['new_source'] = "./upload/".$fileupload['new_name'];
	} else {
		echo "Register: No file <br>";
		print_r($_FILES);
		echo "<br>";
		print_r($_POST);
	}

	if ($db->registerUser($_POST['vorname'], $_POST['nachname'], $_POST['username'], 
			$_POST['email'], $_POST['password'], $fileupload['new_name'])){
	    if (!empty($fileupload)) {			

	    	// Resize image
			$image = imagecreatefromjpeg($fileupload['tmp_name']);
			$thumbnail = imagescale($image, 102, 102);
			if (!empty($thumbnail)) {
				imagejpeg($thumbnail, $fileupload['new_source']);
			} else {
				echo "Thumbnail fail";
			}

			imagedestroy($image);
			imagedestroy($thumbnail);
		}
	} else  echo "User registration failed";
}

// Save rss to user
if (isset($_POST['rss_export'])) {
	// echo "Save ".$_POST['rss_export'];
	$file = $_POST['rss_export'];
	if (file_exists($file)) {
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.basename($file));
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($file));
		ob_clean();
		flush();
		readfile($file);
		exit;
	} else {
		echo "File '".$_POST['rss_export']."' couldn't be opened";
	}
}

// Recover Pass
if (isset($_POST['recover'])) {
	$email = $db->getUserEmail($_POST['username']);
	if ($email) {
		$newpass = $db->resetPassword($_POST['username']);

		if ($newpass) {
			$msg = "Your new password is ".$newpass;
			mail($email, "New Password", $msg);
		} else echo 'Fail: update new password';

	} else echo "Username '".$_POST['username']."' not found";
}


// Check for remember user
if (isset($_POST["login"]) && 
	$db->authenticateUser($_POST["username"], $_POST["password"])){

	if (isset($_POST["remember"]) && $_POST["remember"] == "yes") {
		setcookie("username", $_POST["username"], time() + (86400 * 30));
	}

	$login = true;
	$_SESSION["username"] = $_POST["username"];
} else if (isset($_COOKIE["username"])) {
	setcookie("username", "", time() - 3600);
}
?>
<html>
<head>
	<?php include "includes/head.php"; ?>
</head>
<body>
<?php

if (isset($_SESSION["username"])) {
	include "webtop.php";
} else if ($login) {
	include "webtop.php";
} else if (isset($_POST["register"])) {
	include "includes/registration.php";
} else if (isset($_POST["forgotten"])) {
	include "includes/forgotten.php";
} else {
	include "login.php";
}

?>


<script src="js/gallery.js"></script>
<script src="js/functions.js"></script>
<script src="js/rss.js"></script>
<script src="js/feed.js"></script>
</body>
</html>