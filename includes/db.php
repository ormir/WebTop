<?php
$servername="db4free.net";
$username="webtop";
$password="webtop";
$db="webtop";



// Create connection
global $mysqli;
// $mysqli = new mysqli("$servername:$port", $username, $password, $db);
$mysqli = new mysqli($servername, $username, $password, $db);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}?>