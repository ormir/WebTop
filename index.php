<?php 
session_start();
$loggin = false;

// Check for remember user
if (isset($_POST["login"]) && authenticateuser($_POST["username"], $_POST["password"])){
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
	} else {
		include "login.php";
	}

	function authenticateuser($user, $password){
		if ($user == "1" && $password == "1") {
			return true;
		} else {
			return false;
		}
	}
?>
<script src="js/drop.js"></script>
<script src="js/gallery.js"></script>
<script src="js/functions.js"></script>
</body>
</html>