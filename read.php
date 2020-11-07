<?php
require_once('function.php');

if(isset($_POST['read']) || $_POST['id'])
{
	$blog = fetchBlog($_POST['id']);
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
	<title>Comprehension Passages</title>
</head>
<body>
	<h1 id="top">Comprehensions From The Past</h1>
	<p><a href="index.php">Home</a> / <a href="#"><?php echo htmlentities($blog['blog_title']);?></a></p>
	<h2><?php echo htmlentities($blog['blog_title']); ?></h2>
	<p><?php echo ($blog['blog_content']); ?></p>
	<p><a href="#top">Back to top</a></p>
</body>
</html>