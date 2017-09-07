<?php
	session_start();
	

	$uname=$_SESSION['the_username'];
	
	include("connection_elements.php");

	$user_check=$_SESSION['the_username'];

	$ses_sql="SELECT username, password, email FROM users WHERE username= '$user_check'";		//stores the info of the specific username from the database and store it in the variable $ses_sql. Here, the info selected was composed of the Username, password, email. Here, only one user was selected and it is the one with Username-'$user_check'. Without this, all the info from the database would have been selected.

	$result=$conn->query($ses_sql);		//we make a query (or an array of values from ses_sql)

	$row=$result->fetch_assoc();		//row becomes the array in which we store each value or info of all users stored in the $result
	

	$login_session = $row['username'];

	if(!isset($_SESSION['the_username']))
	{
		header("location: sign_in_page.php");
	}
	
	mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="profile_page.css">
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</head>

<body style="">


<div class="container-fluid" style="margin: auto; max-width: 1200px;">
	<div class="row" style="background-color: #0066ff; padding-top:30px; padding-bottom: 40px; border-bottom: 1px solid blue;" >
		<div class="col-md-3" style="padding-left: 100px;"><a href="home_page_in.php"><img src="http://logos.textgiraffe.com/logos/logo-name/Kenneth-designstyle-boots-m.png" width="190px" height="80px"></a></div>
		
		<div class="col-md-6" style="padding-top: 30px;">
			<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Search Book by Title or ISBN" name="search" />
    					<div class="input-group-btn">
        					<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
    					</div>
				</div>
			</form>
		</div>

		<div class="col-md-3">
			<div class='col-md-4' style='padding-top: 30px;'>

			<div class="dropdown">
				<a href='profile_page.php'><font color="black" size="3"><?php echo $uname; ?></font><span class="glyphicon glyphicon-chevron-down" style="color: black;"></span> </a>

				<div class="dropdown-content">
					<a href="profile_page.php">Profile</a>
					<a href="your_books.php">Your books for sale</a>
					<a href="add_books.php">Add books</a>
					<a href="sign_in_page.php">Sign out</a>

				</div>
			</div>
			</div>


			<div class="col-md-2" style="text-align: right;padding-top: 30px"><a href=""><font color="black" face="times new roman" size="2">ENG</font></a></div>
			<div class="col-md-2" style="text-align: right;padding-top: 30px"><a href=""><font color="black" face="times new roman" size="2">FRE</font></a></div>
		</div>
	</div>


	
</div>

<div class="container-fluid" style="margin: auto; max-width: 1200px;">
<div class="row" style="background-image: url('http://lava360.com/wp-content/uploads/2014/01/Classic-Background-Images-For-Wordpress-Blogs-2.jpg');"> 

<div class="row" style="text-align: center;"><h2><font style="color: silver;" face="ubuntu">Add books</font></h2></div>

<div class="row" style="text-align: center; padding-top: 20px; padding-bottom: 430px; padding-right: 450px; padding-left: 450px; ">
	

		<form name="info" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">

			<div class="form-group"><input type="text/password" name="booktitle" placeholder="Book Title" class="form-control" id="booktitle" pattern="[A-Za-z0-9 ]+" required></div>

			<div class="form-group"><input type="text/password" name="edition" placeholder="Edition" class="form-control" id="edition" pattern="[0-9]+"></div>

			<div class="form-group"><input type="text/password" name="isbn" placeholder="ISBN (optional)" class="form-control" id="isbn" pattern="[0-9]+"></div>

			<div class="form-group"><input type="text/password" name="price" placeholder="Price" class="form-control" id="price" required></div>

			<div class="form-group"><textarea rows="10" cols="44" type="text" name="description" placeholder="Description"></textarea></div>

			<div class="form-group"><input type="file" name="fileToUpload" id="fileToUpload"></div>

			<div class="form-group"><input  type="submit" class="btn btn-success btn-block" value="Add book" required></div>



		</form>

	

		
	</div>

</div>
</div>

<div>
<?php 
$search="";

		if($_SERVER["REQUEST_METHOD"]=="POST")
		{
			if(isset($_POST['search']))
			{
				$search=$_POST['search'];
			}
		}

		echo "<h1>".$search ."</h1>";


$message=$_SESSION['message'];


if(($message=="sign_up") || ($message=="sign_in"))
{//start signup
	
	if($message=="sign_up")
	{
		$times=$_SESSION['times'];
		if($_SESSION['times']==0)
		{
			echo "Welcome ". $login_session;
			$_SESSION['times'] = $_SESSION['times'] + 1;			//so that the page shows a welcome message only once which is when the user susccessfuly signed up 
		}		
	}

	if($message=="sign_in")
	{
		$sign_in_times=$_SESSION['sign_in_time'];
		if($sign_in_times == 0)
		{
			echo "Welcome back!";
			$_SESSION['sign_in_time']++;
			echo $sign_in_times;
		}
	}
	
}
	



/*if($conn->query($sql) === TRUE)
{
    echo "uploaded to mysql!<br>";

    echo "<img src='". $target_file ."' width='1000' height='1000'>";
}*/



$counter=0;

$booktitle=$edition=$isbn=$price=$book_description="";
	


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$ready=1;
		$target_dir="uploads/";
		$target_file=$target_dir. basename($_FILES['fileToUpload']['name']);        //this is where the image file ig gonna get moved into
		$new_name = $target_dir.$uname.basename($_FILES['fileToUpload']['name']);
		$image_filetype=pathinfo($target_file, PATHINFO_EXTENSION);

		if(isset($_POST['submit']))
		{
		    $check= getimagesize($_FILES['fileToUpload']['tmp_name']);
		    if($check !== false)
		    {
		        echo "File is an image! ". $check['mime']. "<br>";
		        $ready=1;
		    }

		    else
		    {
		        echo "file is not an image!<br>";
		        $ready=0;
		    }
		}

		if(($image_filetype != "jpg") && ($image_filetype != "jpeg") && ($image_filetype != "png") && ($image_filetype != "gif"))
		{
		    echo "<h1>not a valid image extension!</h1><br>"; 
		    $ready=0; 
		}

		if(file_exists($target_file))
		{
		    echo "The image already exists with the same name!<br>";
		    $ready=0;
		}

		if($_FILES['fileToUpload']['size']>5000000)
		{
		    echo "Your file is too large!<br>";
		    $ready=0;
		}

		$not_ready=0;			//0 is not ready
		if(($ready==0))
		{
		    echo "the image upload failed!<br>";
		    $not_ready=0;
		}

		else
		{
		    if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file))
		    {
		        echo "the file ". basename($_FILES['fileToUpload']['name']) . " has been uploaded!<br>";
		        $not_ready=1;
		    }

		    else
		    {
		        echo "the file is not uploaded!<br>";
		        $not_ready==0;
		    }
		    
		}
	

		if(isset($_POST['booktitle']))
		{
			if(!empty($_POST['booktitle']))
			{

				$booktitle=$_POST['booktitle'];
				$counter++;
				$new_name = $target_dir.$uname.$booktitle.basename($_FILES['fileToUpload']['name']);;
			}
		}

		if(isset($_POST['edition']))
		{
			if(!empty($_POST['edition']))
			{
				$edition=$_POST['edition'];
				$counter++;
			}
		}

		if(isset($_POST['isbn']))
		{
			if(!empty($_POST['isbn']))
			{
				$isbn=$_POST['isbn'];
				$counter++;
			}
		}

		if(isset($_POST['price']))
		{
			if(!empty($_POST['price']))
			{
				$price=$_POST['price'];
				$counter++;
			}
		}

		if(isset($_POST['description']))
		{
			if(!empty($_POST['description']))
			{
				$description=$_POST['description'];
				$counter++;
			}
		}
		
		

			if(($counter>0) && ($not_ready == 1))
			{
				include("connection_elements.php");
				
				$sql = "INSERT INTO books (seller, book_title, edition, isbn, price, image_name) VALUES ('$uname', '$booktitle', '$edition', '$isbn', '$price', '$new_name')";

				if($conn->query($sql) == TRUE)
				{
					echo "new value is added";
				}
					
				mysqli_close($conn);
			}

			else
			{
				echo "upload failed!<br>";
			}

			rename($target_file, $new_name);
	
		}
		
		
	




	
?>
</div>

</body>
</html>