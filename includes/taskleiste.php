<div id="taskmenu">
	<h2><?php echo $_SESSION["username"]; ?><a href="logout.php"><img id="image-logout" src="images/logout.png"></a></h2>
	
	<div id="taskmenucontent">
		<p onclick="openWindow(fhtw_window)">Technikum Wien</p>
		<p onclick="openWindow(phpinfo_window)">PHP</p>
		<p onclick="openWindow(gallery_window)">Gallery</p>
		<p onclick="openWindow(profile_window)">Edit Profile</p>
	</div>
</div>
<div id="taskleiste">
	<img id='taskleiste-icon' src="images/logo.png">
</div>