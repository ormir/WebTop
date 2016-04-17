<?php
// global $mysqli;
	$sql = "SELECT firstname, lastname, username, email FROM user WHERE username = $_SESSION['username']";
	echo $sql;
	// $result = $mysqli->query($sql);

	// if ($result->num_rows == 1) {
	//     while($row = $result->fetch_assoc()) {
	//         echo "Vorname: " . $row["firstname"]. "<br>"  . "Nachname: " . $row["lastname"]. "<br>" . "Username: " . $row["username"]. "<br>" . "Email: " . $row["email"] . "<br>";
	//     }
 //    }
    
?> 