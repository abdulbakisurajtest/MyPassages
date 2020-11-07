<?php
function login($username, $password)
{
	if(!empty($username) && !empty($password))
	{
		if(($username == 'fliplikesuraj') && ($password == 'fliplikesuraj'))
		{
			return 'success';
		}
		elseif(($username != 'fliplikesuraj') || ($password != 'fliplikesuraj'))
		{
			return 'incorrect username or password';
		}
	}
	else
	{
		return('all fields must not be empty');
	}
}

function loginMessage()
{
	if(isset($_SESSION['loginerror']))
	{
		echo $_SESSION['loginerror'];
		unset($_SESSION['loginerror']);
	}
}
function validate($location)
{
	if(!isset($_SESSION['login']))
	{
		header('Location: '.$location);
		return;
	}
}
function displayBlogList()
{
	include('pdo.php');
	$sql = "SELECT * FROM blog";
	$stmt1 = $pdo->query($sql);
	$stmt2 = $pdo->query($sql);
	$exists = $stmt1->fetch(PDO::FETCH_ASSOC);
	echo '<table border="1">';
	echo '<thead>';
	echo '<th>Blog Title</th>';
	echo '<th>Date created</th>';
	echo '<th>Last edited</th>';
	echo '<th>Action</th>';
	echo '</thead>';
	echo '<tbody>';
	if($exists>0)
	{
		while($row = $stmt2->fetch(PDO::FETCH_ASSOC))
		{
			echo '<tr>';
			echo '<td>'.$row['blog_title'].'</td>';
			echo '<td>'.date('j/m/Y - g:ia',$row['date_posted']).'</td>';
			echo '<td>'.date('j/m/Y - g:ia',$row['date_edited']).'</td>';
			echo '<td>
					<form method="post" action="edit.php">
						<input type="hidden" name="id" value="'.$row['blog_id'].'" />
						<input type="submit" name="edit" value="edit" />
					</form>
					<form method="post" action="delete.php">
						<input type="hidden" name="id" value="'.$row['blog_id'].'" />
						<input type="submit" name="delete" value="delete" />
					</form>
				</td>';
			echo '</tr>';
		}
	}
	else
	{
		echo '<tr>';
		echo '<td colspan="4" style="text-align: center;">No data available</td>';
		echo '</tr>';
	}
	echo '</tbody>';
	echo '</table>';
}
function publishBlog($title, $content, $date)
{
	include ('pdo.php');
	$sql = "INSERT INTO blog (blog_title, blog_content, date_posted, date_edited) VALUES (:title, :content, :posted, :edited)";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array(
		':title'=>$title,
		':content'=>$content,
		':posted'=>$date,
		':edited'=>$date
	));
	return 'success';
}
function addMessage()
{
	if(isset($_SESSION['addMessage']))
	{
		echo $_SESSION['addMessage'];
		unset($_SESSION['addMessage']);
	}
}
function fetchBlog($id)
{
	include ('pdo.php');
	$sql = "SELECT * FROM blog WHERE blog_id = :blog_id";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array('blog_id'=>$id));
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
	if($row>0)
	{
		return $row;
	}
	else{
		return 'Error fetching blog';
	}
}
function updateBlog($id, $title, $content, $date)
{
	include ('pdo.php');
	$sql = "UPDATE blog SET blog_title = :title, blog_content = :content, date_edited = :date WHERE blog_id = :id";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array(
		':title'=>$title,
		':content'=>$content,
		':date'=>$date,
		':id'=>$id
	));
	return 'success';
}
function removeBlog($id)
{
	include ('pdo.php');
	$sql = "DELETE FROM blog WHERE blog_id = :id";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array(':id'=>$id));
	$sql = "SELECT * FROM blog WHERE blog_id = :id";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array(':id'=>$id));
	if($stmt>0)
	{
		return 'failed to delete';
	}
	else
	{
		return 'success';
	}
}
function displayBlogHeader()
{
	include('pdo.php');
	$sql = "SELECT * FROM blog";
	$stmt1 = $pdo->query($sql);
	$stmt2 = $pdo->query($sql);
	$exists = $stmt1->fetch(PDO::FETCH_ASSOC);
	if($exists>0)
	{
		while($row = $stmt2->fetch(PDO::FETCH_ASSOC))
		{
			echo '<li>';
			echo '<h3>'.$row['blog_title'].'</h3>';
			echo '<p>Written on: '.date('j/m/Y - g:ia',$row['date_posted']).'</p>';
			echo '<p>Last edited: '.date('j/m/Y - g:ia',$row['date_edited']).'</p>';
			echo '
					<form method="post" action="read.php">
						<input type="hidden" name="id" value="'.$row['blog_id'].'" />
						<input type="submit" name="read" value="Read" />
					</form>
				';
			echo '</li>';
		}
	}
	else
	{
		echo "<li><p>No data available</p></li>";
	}
}