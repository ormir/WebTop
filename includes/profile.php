<div>
<?php
	$userInfo = $db->getUserInfo($_SESSION['username']);
	if ($userInfo) {?>

		<div id="profile-picture"><img src='upload/<?php echo  $userInfo['pic']; ?>'></div>
		<input type="file" title=" " id="fileToUpload"><br/>
    	<input id="up-button" type="submit" value="Upload Image" name="submit"><br/>
		
		<div id="personalinfo">
			<h3 id="lucida">
				<span>
					<span class='profile_edit' id='profirstname'><? echo $userInfo["firstname"]; ?></span>
					<input data-type=firstname type='text'/>
				</span>
				<span>
					<span class='profile_edit' id='prolastname'><? echo $userInfo["lastname"]; ?></span>
					<input data-type=lastname type='text'/>
				</span>
			</h3>
			<h3>
				<span id='prousername'><? echo $userInfo["username"]; ?></span>
			</h3>
			<h3 id="lucida">
				<span class='profile_edit' id='proemail'><? echo $userInfo["email"]; ?></span>
				<input data-type=email type='text'/>
			</h3>

			<button id='profile-save' class='profile-editing'>save</button>
			<button id='profile-cancel' class='profile-editing'>cancel</button>
		</div>
<?php } ?>
</div>