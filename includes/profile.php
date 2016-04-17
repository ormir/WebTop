<div>
<?php
	global $mysqli;
	$sql = "SELECT firstname, lastname, username, email FROM user WHERE username = '".$_SESSION['username']."'";

	$result = $mysqli->query($sql);

	if ($result->num_rows == 1) {
		$row = $result->fetch_assoc();

		?>
		<h3>
			<span>
				<span class='profile_edit' id='profirstname'><? echo $row["firstname"]; ?></span>
				<input type='text'/>
			</span>
			<span>
				<span class='profile_edit' id='prolastname'><? echo $row["lastname"]; ?></span>
				<input type='text'/>
			</span>
		</h3>
		<h3>
			<span class='profile_edit' id='prousername'><? echo $row["username"]; ?></span>
			<input type='text'/>
		</h3>
		<h3>
			<span class='profile_edit' id='proemail'><? echo $row["email"]; ?></span>
			<input type='text'/>
		</h3>
	<?php } ?>
<button id='profile-save' class='profile-editing'>save</button>
<button id='profile-cancel' class='profile-editing'>cancel</button>
</div>