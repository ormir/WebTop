<?php 
session_start();
$login = false;

include "includes/db.php";

// Register User
if (isset($_POST['submit-register'])) {
	// print_r($_POST);
	$sql = "INSERT INTO user (firstname, lastname, username, email, pwd, bild)".
		" VALUES ('".$_POST['vorname']."', '".$_POST['nachname']."', '".$_POST['username']."', '".$_POST['email']."', '".md5($_POST['password'])."', NULL);";
	// echo $sql;
	if ($mysqli->query($sql) === TRUE) {
	    // echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $mysqli->error;
	}

}

// Recover Pass
if (isset($_POST['recover'])) {
	$sql = "SELECT email FROM user WHERE username = '".$_POST['username']."'";
	// echo $sql;

	$result = $mysqli->query($sql);
	if ($result->num_rows == 1) {
		$row = $result->fetch_assoc();
		// echo "Username '".$_POST['username']."' has email '".$row['email']."'";
		$newpass = randomPassword();
		// echo "New Password: ".$newpass;
		$sql = "UPDATE user SET pwd = '".md5($newpass)."' WHERE username ='".$_POST['username']."'";
		// echo $sql;
		echo $newpass;
		if($mysqli->query($sql)=== TRUE){
			// echo"Successful woo";
			$msg = "Your new password is ".$newpass;
			mail($row['email'], "New Password", $msg);
		}else{
			echo "Fail:".$mysqli->error;
		}
	} else {
		echo "Username '".$_POST['username']."' not found";
	}
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
	} else if (isset($_POST["register"])) {
		include "includes/registration.php";
	} else if (isset($_POST["forgotten"])) {
		include "includes/forgotten.php";
 	} else {
		include "login.php";
	}

	function authenticateuser($user, $password){
		global $mysqli;
		$sql = "SELECT username FROM user WHERE username = '$user' AND pwd = '".md5($password)."'";
		$result = $mysqli->query($sql);

		if ($result->num_rows == 1) {
			return true;
		} else {
			echo "log in failed";
			return false;
		}
	}

function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

?>


<script src="js/gallery.js"></script>
<script src="js/functions.js"></script>
</body>
</html>