<?php

class WebtopDB {
	private $servername = "db4free.net";
	private $username = "webtop";
	private $password = "webtop";
	private $db = "webtop";

	private $mysqli;

	public function __construct() {
		// Create connection
		$this->mysqli = new mysqli($this->servername, $this->username, $this->password, $this->db);

		// Check connection
		if ($this->mysqli->connect_error)
		    die("Connection failed: " . $this->mysqli->connect_error);
	}

	public function authenticateUser($user, $password) {
		$sql = "SELECT username FROM user WHERE username = '$user' AND pwd = '".md5($password)."'";
		$result = $this->mysqli->query($sql);
		return $result->num_rows == 1;
	}

	public function registerUser($firstname, $lastname, $username, $email, $pwd, $pic) {
		$sql = "INSERT INTO user (firstname, lastname, username, email, pwd, pic)".
			" VALUES ('".$firstname."', '".$lastname."', '".$username."', '".$email."', '"
			.md5($pwd)."', '".$pic."');";
		return $thir->mysqli->query($sql) === TRUE;
	}

	public function getUserEmail($username) {
		$sql = "SELECT email FROM user WHERE username = '".$_POST['username']."'";
		$result = $this->mysqli->query($sql);
		return $result->num_rows == 1 ? ($result->fetch_assoc())['email'] : false;
	}

	public function resetPassword($username) {
		$newpass = $this->randomPassword();
		$sql = "UPDATE user SET pwd = '".md5($newpass)."' WHERE username ='".$username."'";
		return $this->mysqli->query($sql) === TRUE;
	}

	public function getAllPositions($username) {
		$sql= "SELECT apps.name, user_app.top, user_app.left 
			FROM user_app 
				join apps on apps.id = user_app.fk_app_id
			where fk_user_id = (select id from user where username = '".$username."')
				and user_app.status = 1";

		$result = $this->mysqli->query($sql);
		$elements = array();
		if($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$elements[$row['name']] = ['top' => $row['top'], 'left' => $row['left']];
			}
		}

		return $elements;
	}

	public function deletePosition($elementId, $username) {
		$sql = "UPDATE user_app SET status = 0 WHERE fk_app_id = "
			."(SELECT id FROM apps WHERE name = '".$elementId."') ".
			"AND fk_user_id = (SELECT id FROM user WHERE username = '".$username."')";

		return $this->mysqli->query($sql) === TRUE;
	}

	public function savePosition($element, $username) {
		//selecting data from table user_app
		//then using subquery to get id from user and id from app
		$sql = "SELECT id FROM user_app WHERE fk_user_id = ".
						"(SELECT id FROM user WHERE username = '".$username."') ".
					"AND fk_app_id = (SELECT id FROM apps WHERE name = '".$element['id']."')";

		$result = $this->mysqli->query($sql);

		//update data if there is already some data in table
		if(($result->num_rows) == 1){
			$row=$result->fetch_assoc();
			$sql = "UPDATE user_app SET status=1, top= ".$element['top'].", `left`= ".$element['left']." WHERE id= ".$row['id']; 
			if($this->mysqli->query($sql) !== TRUE){
				echo "Element ".$element['id']." couldn't be saved";
			}
		}else{
			//insert some new data if row in table is empty
			$sql = "INSERT INTO user_app (fk_user_id, fk_app_id, status, top, `left`) VALUES  (".
				"(SELECT id FROM user WHERE username = '".$username."'), ".
				"(SELECT id FROM apps WHERE name = '".$element['id']."'), 1, ".$element['top'].", ".$element['left'].")";

			if($this->mysqli->query($sql) !== TRUE){
				echo "Element ".$element['id']." couldn't be inserted";
			}
		}
	}

	public function editProfile($changes, $username) {
		$set = "";

		// Organise changes for query
		foreach ($changes as $colum => $value) {
			$set = $set.$colum."='".$value."', ";
		}

		// Remove last comma
		$set = substr($set, 0, -2);

		$sql = "UPDATE user SET ".$set." WHERE username = '".$username."'";

		if ($this->mysqli->query($sql) !== TRUE) {
		    echo '{"success":0, "message":"Error updating record: '.$this->mysqli->error.'"}';
		}
	}

	public function getUserInfo($username) {
		$sql = "SELECT firstname, lastname, username, email, pic ".
				"FROM user WHERE username = '".$username."'";
		$result = $this->mysqli->query($sql);

		if ($result->num_rows == 1) {
			$row = $result->fetch_assoc();
			return $row;
		}

		return false;
	}

	private function randomPassword() {
	    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
	    $pass = array(); //remember to declare $pass as an array
	    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	    for ($i = 0; $i < 8; $i++) {
	        $n = rand(0, $alphaLength);
	        $pass[] = $alphabet[$n];
	    }
	    return implode($pass); //turn the array into a string
	}

	public function addRss($title, $link, $description, $date) {
		$sql1 = "INSERT INTO rss (title, link, description, date)".
			" VALUES ('".$title."', '".$link."', '".$description."', STR_TO_DATE('".$date."','%d.%m.%Y %H:%i:%s'));";

		$sql2 = "select * from rss where title = '".$title."' and link = '".$link."';";

		

		if ($this->mysqli->query($sql1) === true) {
			$result = $this->mysqli->query($sql2);
			$row = $result->fetch_assoc();
			return ["success" => 1, "rss" => $row];
		} else {
			return ["success" => 0, "sql" => $sql ,"message" => "Error adding rss: ".$this->mysqli->error];
		}
	}

	public function getAllRss() {
		$sql= "SELECT * FROM rss order by `date` desc;";

		$result = $this->mysqli->query($sql);
		$elements = array();
		if($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$elements["id-".$row['id']] = ['id' => $row['id'], 
										'title' => $row['title'], 
										'link' => $row['link'],
										'description' => $row['description'],
										'date' => $row['date']];
			}
		}

		return $elements;
	}

	public function editRss($changes) {
		$set = "";

		// Organise changes for query
		foreach ($changes as $colum => $value) {
			if($colum != "id")
				$set = $set.$colum."='".$value."', ";
		}

		// Remove last comma
		$set = substr($set, 0, -2);

		$sql = "UPDATE rss SET ".$set." WHERE id = '".$changes['id']."'";

		// return $sql;

		if ($this->mysqli->query($sql) === TRUE) {
			return ["success" => 1];
		} else {
		    echo '{"success":0, "message":"Error updating rss: '.$this->mysqli->error.'"}';
		}
	}

	public function deleteRss($id) {
		$sql = "delete from rss where id = ".$id.";";

		if ($this->mysqli->query($sql) === TRUE) {
			return ["success" => 1];
		} else {
		    return ["success" => 0, "message" => "Error deleting rss: ".$this->mysqli->error];
		}
	}
}

?>