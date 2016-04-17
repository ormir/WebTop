<div id = "login">
	<img id="register-icon" src="images/register.png">
	<div id = "preview"></div>
	<div id="upload-reg">
		<!--removing the no file selected text and adjusting space-->
		&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<input type="file" title=" " id="fileToUpload"><br/>
    	<input type="submit" value="Upload Image" name="submit"><br/>
    </div id="register">
	<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"><br/>
		<h2 id="logintext">Register</h2>
		<input type="text" name="vorname" placeholder="Vorname" autofocus/><br/>
		<input type="text" name="nachname" placeholder="Nachname"/><br/>			
		<input type="text" name="usernmae" placeholder="Username" /><br/>
		<input type="password" name="password" placeholder="Passwort" /><br/>
		<input type="email" name="email" placeholder="E-Mail" /><br/>
		<button type="submit" name="register">Register</button>
	</form>
</div>