<div id="recovery">
	<form role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
		<img id="login-icon" src="images/logo.png">
		<h2 id="logintext">Password Recovery</h2>
		<input type="text" name="username" placeholder="Username" autofocus required><br />
		<button type="submit" name="recover">Send Password</button>
	</form>
</div>
