<div id="login">
	<form role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
		<img id="login-icon" src="images/logo.png">
		<h2 id="logintext">Password Recovery</h2>
		<input type="text" name="username" placeholder="Username" required autofocus></br>
		<button type="submit" name="login">Reset</button><br/>
	</form>
</div>
