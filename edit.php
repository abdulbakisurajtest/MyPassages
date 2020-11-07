<?php
session_start();
require_once('function.php');
validate('index.php');

if(isset($_POST['update']))
{
	$date = time();
	updateBlog($_POST['id'], $_POST['title'], $_POST['content'], $date);
	header('Location: admin.php');
	return;
}

if(isset($_POST['edit']) || $_POST['id'])
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
	<title>Edit Blog</title>
</head>
<body>
	<h1>Edit Blog</h1>
	<p><a href="admin.php">Click here to go back</a></p>
	<form method="post" action="edit.php" autocomplete="off">
		<input type="hidden" name="id" value="<?php echo $blog['blog_id']; ?>" />
		<label>
			Blog Title<br/>
			<input type="text" name="title" value="<?php echo $blog['blog_title'];?>" required="required" />
		</label><br/>
		<label>
			Blog Content<br/>
			<textarea cols="75" rows="10" name="content" required="required"><?php echo $blog['blog_content']; ?></textarea>
		</label><br/>
		<p><?php addMessage(); ?></p>
		<input type="submit" name="update" value="Update" />
	</form>
</body>
</html>