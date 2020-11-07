<?php
session_start();
require_once('function.php');
validate('index.php');

if(isset($_POST['remove']))
{
	removeBlog($_POST['id']);
	header('Location: admin.php');
	return;
}

if(isset($_POST['delete']) || $_POST['id'])
{
	$blog = fetchBlog($_POST['id']);
	if(!is_array($blog))
	{
		header('Location: admin.php');
		return;
	}
}
else
{
	header('Location: admin.php');
	return;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Delete Blog</title>
</head>
<body>
	<h1>Delete Confirmation:</h1>
	<p><a href="admin.php">Click here to go back</a></p>
	<p>You are about to permanently remove "<strong><?php echo $blog['blog_title']; ?></strong>" ? </p>
	<form method="post" action="delete.php" autocomplete="off">
		<input type="hidden" name="id" value="<?php echo $blog['blog_id']; ?>" />
		<input type="submit" name="remove" value="Remove" />
	</form>
</body>
</html>