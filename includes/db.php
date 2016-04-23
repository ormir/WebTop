<?php
// Connect Database
$servername = "localhost";
$db = "webtop";
$username = "root";
$password = "root";
$port = 8889;

// Create connection
global $mysqli;
$mysqli = new mysqli("$servername:$port", $username, $password, $db);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}?>