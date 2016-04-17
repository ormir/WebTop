<div id = "register-top">
	<img id="register-icon" src="images/register.png">
	<div id = "preview"></div>
	<div id="upload-reg">
		<!--removing the no file selected text and adjusting space-->
		&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<input type="file" title=" " id="fileToUpload"><br/>
    	<input id="up-button" type="submit" value="Upload Image" name="submit"><br/>
    </div id="register">
	<form role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post"><br/>
		<h2 id="logintext">Register</h2>
		<input type="text" name="vorname" placeholder="Vorname" autofocus required/><br/>
		<input type="text" name="nachname" placeholder="Nachname" required/><br/>			
		<input type="text" name="username" placeholder="Username" required/><br/>
		<input type="password" name="password" placeholder="Passwort" required/><br/>
		<input type="email" name="email" placeholder="E-Mail" required/><br/>
		<button type="submit" name="submit-register">Register</button>
	</form>
</div>