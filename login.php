<div id="login">
	<form role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
		<img src="images/logo.png">
		<h2>Login to Webtop</h2>
		<input type="text" name="username" placeholder="Username" required autofocus></br>
		<input type="password" name="password" placeholder="Password" required><br>
		<input type="checkbox" name='remember' value="yes">Remember Me</input><br>
		<button type="submit" name="login">Login</button>
	</form>
</div>