<?php if (session_status() === PHP_SESSION_NONE) {
	session_start();
} ?>

<!DOCTYPE html>
<html lang='fr'>
<head>
	<meta charset='utf-8'/>
	<meta http-equiv='X-UA-Compatible' content='IE=edge'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<title>Login</title>
</head>
<body>
<div>
	<h1>Login</h1>
	<?php if (!empty($error)) echo '<p>error: ' . $error . '</p>'; ?>
	<form action='login' method='post'>
        <input type="text" name="username" placeholder="Username">
		<input type='text' name='password' placeholder='Password'>
		<input type='submit' value='Login'>
	</form>
	<p>Don't have an account? <a href='register'>Register</a></p>
</div>
</body>
</html>