<?php
require_once('function.php');

if(isset($_GET['id']))
{
	$blog = fetchBlog($_GET['id']);
	if(!is_array($blog))
	{
		header('Location: index.php');
		return;
	}
}
else
{
	header('Location: index.php');
	return;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>My Passages</title>
</head>
<body>
	<p><a href="index.php">Home</a> / <a href="#"><?php echo htmlentities($blog['blog_title']);?></a></p>
	<h1><?php echo htmlentities($blog['blog_title']); ?></h1>
	<p><?php echo ($blog['blog_content']); ?></p>
	<p><a href="#top">Back to top</a></p>
</body>
</html>