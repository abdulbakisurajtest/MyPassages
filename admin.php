<?php
session_start();
require_once('function.php');
validate('index.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
</head>
<body>
	<h1>Admin Dashboard</h1>
	<h3><a href="add.php">Add New Blog</a></h3>
	<?php displayBlogList(); ?>
	<p><a href="logout.php">Logout</a></p>
</body>
</html>