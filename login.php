<?php
session_start();
require_once('function.php');
if(isset($_POST['login']))
{
	$loginAdmin = login($_POST['username'], $_POST['password']);
	if($loginAdmin == 'success')
	{
		$_SESSION['login'] = 'admin';
		header('Location: admin.php');
		return;
	}
	else
	{
		$_SESSION['loginerror'] = $loginAdmin;
		header('Location: login.php');
		return;
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
	<h1>Login</h1>
	<form method="post" action="login.php" autocomplete="off">
		<label>
			Username<br/>
			<input type="username" name="username" />
		</label><br/>
		<label>
			Password<br/>
			<input type="password" name="password" />
		</label><br/>
		<p style="color: red;"><?= loginMessage(); ?></p>
		<input type="submit" name="login" value="Login" />
</body>
</html>
