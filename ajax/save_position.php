<?php 
session_start();
header('Content-Type: application/json');

if (isset($_POST['element'])){
	include '../includes/db.php';
	$element = $_POST['element'];

	//selecting data from table user_app
	//then using subquery to get id from user and id from app
	$sql = "SELECT id FROM user_app WHERE fk_user_id = ".
					"(SELECT id FROM user WHERE username = '".$_SESSION['username']."') ".
				"AND fk_app_id = (SELECT id FROM apps WHERE name = '".$element['id']."')";

	$result = $mysqli->query($sql);

	//update data if there is already some data in table
	if(($result->num_rows) == 1){
		$row=$result->fetch_assoc();
		$sql = "UPDATE user_app SET status=1, top= ".$element['top'].", `left`= ".$element['left']." WHERE id= ".$row['id']; 
		if($mysqli->query($sql) !== TRUE){
			echo "Element ".$element['id']." couldn't be saved";
		}
	}else{
		//insert some new data if row in table is empty
		$sql = "INSERT INTO user_app (fk_user_id, fk_app_id, status, top, `left`) VALUES  (".
			"(SELECT id FROM user WHERE username = '".$_SESSION['username']."'), ".
			"(SELECT id FROM apps WHERE name = '".$element['id']."'), 1, ".$element['top'].", ".$element['left'].")";

		if($mysqli->query($sql) !== TRUE){
			echo "Element ".$element['id']." couldn't be inserted";
		}
	}

	// $_SESSION['elements'][$element['id']] = ['top' => $element['top'], 'left' => $element['left']];
	// echo json_encode($_SESSION['elements']);
}



?> 