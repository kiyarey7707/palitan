<?php
	session_start();
	$uname=$_SESSION['the_username'];

	
	include("connection.php");

	$user_check=$_SESSION['the_username'];


	if(!isset($_SESSION['the_username']))
	{
		header("location: sign_in_page.php");
	}
	

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

<body>



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
				<a href='profile_page.php'><font color="black"><?php echo $uname; ?></font><span class="glyphicon glyphicon-chevron-down" style="color: black;"></span> </a>

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

<div class="container-fluid" style="margin: auto; max-width: 1200px; border: solid black;">


<div class="row" style="text-align: center;"><h2><font style="color: silver;" face="ubuntu">Your books for sale</font></h2></div>

<div class="row" style="text-align: center;">
	
	<h1>These are your books on sale</h1>	
	</div>

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
	
	$rank="";
	$message=$_SESSION['message'];

	if(($message=="sign_up") || ($message=="sign_in"))
	{
		include("connection_elements.php");

		$sql= "SELECT seller, book_title, edition, isbn, price, image_name FROM books"; 

		$result=$conn->query($sql);

		if($result->num_rows > 0)
		{
			while($row=$result->fetch_assoc())
			{

				
				if($uname== $row['seller'])
				{
					if((int)$row['edition'] == 1)
					{
						$rank="st";
					}

					else if((int)$row['edition'] == 2)
					{
						$rank="nd";
					}

					else if((int)$row['edition']==3)
					{
						$rank="rd";
					}

					else
					{
						$rank="th";
					}
					echo "
						<div class='row'>
	
						<div class='col-md-5'>Ads</div>
						<div class='col-md-2' style='padding-top:10px; padding-bottom:10px;'><img src='" . $row['image_name'] ."' width='80' height='100'></div>
						<div class='col-md-4'>
						<font face='times' size='5'>". $row['book_title']. " (". $row['edition'] . $rank. " edition)". "</font><br>
						<font face='times' size='2'>ISBN: " . $row['isbn'] . "</font>
						</div>
						<div class='col-md-1'><font face='times' size= 6>$". (double)$row['price']."</font></div>
						</div>";


					
				}
				
			}
		}

	}

?>




</div>




</body>
</html>

