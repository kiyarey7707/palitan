<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
	
	$server="localhost";
	$user="root";
	$password="rAt38CatFB";

	$database="users_and_books";

	$conn= new mysqli($server, $user, $password, $database);

	if($conn->connect_error)
	{
		die("connection error!<br>". connect_error);
	}

	else
	{
		//echo "connection is successful!<br>";
	}

	//$sql="DROP TABLE users_info";
	//$sql="CREATE TABLE books (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, owner VARCHAR(100) NOT NULL, book_title VARCHAR(100) NOT NULL, edition VARCHAR(3) NOT NULL, isbn VARCHAR(13) NOT NULL, course_name VARCHAR(100) NOT NULL, course_code VARCHAR(20) NOT NULL, school VARCHAR(100) NOT NULL, price VARCHAR(5) NOT NULL, reg_date TIMESTAMP)";

	/*$sql="CREATE TABLE users (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, username VARCHAR(100) NOT NULL, email VARCHAR(100) NOT NULL, password VARCHAR(100) NOT NULL, reg_date TIMESTAMP)";*/

	/*if($conn->query($sql) === TRUE)
	{
		echo "table is created!<br>";
	}

	else
	{
		echo "table is not created!<br>";
	}*/
	
	
?>
</body>
</html>