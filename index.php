<?php 
session_start();
$login = false;

$servername = "localhost";
$db = "webtop";
$username = "root";
$password = "root";
$port = 8889;

// Create connection
$mysqli = new mysqli("$servername:$port", $username, $password, $db);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

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
		global $mysqli;

		if ($mysqli->connect_error) {
		    die("Connection failed: " . $mysqli->connect_error);
		}

		$sql = "SELECT username FROM user WHERE username = '$user' AND pwd = '".md5($password)."'";

		$result = $mysqli->query($sql);

		if ($result->num_rows == 1) {
			return true;
		} else {
			echo "log in failed";
			return false;
		}
	}
?>

<script src="js/gallery.js"></script>
<script src="js/functions.js"></script>
</body>
</html>