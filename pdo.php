<?php
$host = 'localhost';
$port = 3306;
$dbname = 'passages';
$username = 'passages';
$password = 'passages';

try
{
	$pdo = new PDO("mysql: host=$host;port=$port;dbname=$dbname", $username, $password);
}
catch(PDOException $pe)
{
	die("Could not connect to database ($dbname): ".$pe->getMessage());
}
?>