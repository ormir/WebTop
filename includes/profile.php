<div>
<?php
	global $mysqli;
	$sql = "SELECT firstname, lastname, username, email FROM user WHERE username = '".$_SESSION['username']."'";

	$result = $mysqli->query($sql);

	if ($result->num_rows == 1) {
		$row = $result->fetch_assoc();
		// print_r($row);
		// echo "Vorname: " . $row["firstname"]. "<br>"  . "Nachname: " . $row["lastname"]. "<br>" . "Username: " . $row["username"]. "<br>" . "Email: " . $row["email"] . "<br>";

		echo "<h3><span class = 'profile_edit' id ='profirstname'>". $row["firstname"]."</span> ". 
			"<span class = 'profile_edit' id ='prolastname'>".$row["lastname"]."</span></h3>".
			"<h3 class = 'profile_edit' id ='prousername'>".$row["username"]."</h3><br/>".
			"<h3 class = 'profile_edit' id ='proemail'>".$row["email"]."</h3><br/>";
	}
?>
</div>