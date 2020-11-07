<?php
session_start();
require_once('function.php');
validate('index.php');

if(isset($_POST['add']))
{
	$date_created = time();
	$publish = publishBlog($_POST['title'], $_POST['content'], $date_created);
	if($publish == 'success')
	{
		$_SESSION['addMessage'] = 'Blog has been published successfully';
	}
	header('Location: add.php');
	return;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add Blog</title>
</head>
<body>
	<h1>Add New Blog</h1>
	<p><a href="admin.php">Click here to go back</a></p>
	<form method="post" action="add.php" autocomplete="off">
		<label>
			Blog Title<br/>
			<input type="text" name="title" required="required" />
		</label><br/>
		<label>
			Blog Content<br/>
			<textarea cols="75" rows="10" name="content" required="required"></textarea>
		</label><br/>
		<p><?php addMessage(); ?></p>
		<input type="submit" name="add" value="Publish" />
	</form>
</body>
</html>