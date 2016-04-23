<?php 
session_start();
header('Content-Type: application/json');
	
if(isset($_SESSION['username'])){
	include '../includes/db.php';
	$sql= "SELECT apps.name, user_app.top, user_app.left 
			FROM user_app 
				join apps on apps.id = user_app.fk_app_id
			where fk_user_id = (select id from user where username = '".$_SESSION['username']."')
				and user_app.status = 1";

	$result = $mysqli->query($sql);
	$elements = array();
	if($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$elements[$row['name']] = ['top' => $row['top'], 'left' => $row['left']];
		}
	}
	echo json_encode($elements);
	$mysqli->close();
}
?>