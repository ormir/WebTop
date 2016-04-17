<div id="login">
	<form role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
		<img id="login-icon" src="images/logo.png">
		<h2 id="logintext">Login to Webtop</h2>
		<input type="text" name="username" placeholder="Username" required autofocus></br>
		<input type="password" name="password" placeholder="Password" required><br>
		<input type="checkbox" name='remember' value="yes"><a id="logintext">Remember Me</a></input><br>
		<button type="submit" name="login">Login</button><br/>
		<a href="" id="forgotten">Forgotten password?</a>
	</form>
</div>
