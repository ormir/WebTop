<?php
global $mysqli;

<div id = "profile">
	$sql = "SELECT firstname, lastname, username, email";
	$result = $mysqli->query($sql);

	if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "Vorname: " . $row["firstname"]. "<br>"  . "Nachname: " . $row["lastname"]. "<br>" . "Username: " . $row["username"]. "<br>" . "Email: " . $row["email"] . "<br>";
    mysqli_close($mysqli_);

</div>
?> 