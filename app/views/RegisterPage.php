<?php if (session_status() === PHP_SESSION_NONE) {
	session_start();
} ?>

<!DOCTYPE html>
<html lang='fr'>
<head>
	<meta charset='utf-8'/>
	<meta http-equiv='X-UA-Compatible' content='IE=edge'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<title>Register</title>
</head>
<body>
<h1>Register</h1>
<?php if (!empty($error)) echo '<p>' . $error . '</p>'; ?>
<form action='register' method='post'>
    <input type='text' name='username' placeholder='Username'>
    <input type='text' name='email' placeholder='Email'>
	<input type='text' name='password' placeholder='Password'>
    <label>
        <select name='language'>
            <option value='' disabled selected>Language</option>
            <option value='english'>English</option>
            <option value='french'>French</option>
            <option value='spanish'>Spanish</option>
            <option value='italian'>Italian</option>
            <option value='german'>German</option>
        </select>
    </label>
	<input type='submit' value='Register'>
</form>
<p>Already have an account? <a href='login'>Login</a></p>
</body>
</html>