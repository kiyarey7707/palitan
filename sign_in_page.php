<?php
	
	

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="sellsite.css">
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  	

</head>

<body style="background-color: #200000;">

<div class="container-fluid" style="margin: auto; max-width: 1200px;">
	<div class="row" style="background-color: #0066ff; padding-top:30px; padding-bottom: 40px; border-bottom: 1px solid blue;" >
		<div class="col-md-3" style="padding-left: 100px;"><a href="home_page.php"><img src="http://logos.textgiraffe.com/logos/logo-name/Kenneth-designstyle-boots-m.png" width="190px" height="80px"></a></div>
		
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
			<div class="col-md-4" style="padding-top: 30px;"><a href="sign_in_page.php"><font size="4" face="times new roman" color="gold">Sign in</font></a></div>
			<div class="col-md-4" style="padding-top: 30px;"><a href="sign_up_page.php"><font size="4" face="times new roman" color="gold">Sign up</font></a></div>
			<div class="col-md-2" style="text-align: right;padding-top: 30px"><a href=""><font color="gold" face="times new roman" size="2">ENG</font></a></div>
			<div class="col-md-2" style="text-align: right;padding-top: 30px"><a href=""><font color="gold" face="times new roman" size="2">FRE</font></a></div>
		</div>
	</div>

	<div class="row" style="background-image: url('http://lava360.com/wp-content/uploads/2014/01/Classic-Background-Images-For-Wordpress-Blogs-2.jpg');"> 
	<div class="row" style="text-align: center; padding-top: 30px;"><h2><font color="silver" face="ubuntu">Sign In</font></h2></div>
	<div class="row" style="text-align: center; padding-top: 20px; padding-bottom: 430px; padding-right: 450px; padding-left: 450px; ">
	

		<form name="info" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
			
			<div class="form-group"><input type="text" name="unamein" placeholder="Username" class="form-control"></div>
			<div class="form-group"><input type="password" name="pwordin" placeholder="Password" class="form-control"></div>

			<div class="form-group"><input type="submit" value="Sign in" class="btn btn-success btn-block"></div>

		</form>
	</div>

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
	$dusername=$dpword="";
	
	
	

	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if(isset($_POST['unamein']))
		{
			if(empty($_POST['unamein']))
			{
				$dusername="";
			}

			else
			{
				$dusername=$_POST['unamein'];
			}
		}

		if(isset($_POST['pwordin']))
		{
			if(empty($_POST['pwordin']))
			{
				$dpword="";
			}

			else
			{
				$dpword=$_POST['pwordin'];
			}
		}
	}

	$found=0;

	if((!(empty($_POST['unamein']))) && (!(empty($_POST['pwordin']))))
	{
		include("connection_elements.php");
		

		$sql="SELECT username, password, id FROM users";

		$result=$conn->query($sql);

		if($result->num_rows > 0)
		{
				while($row=$result->fetch_assoc())
			{
				if((($row['username']) == $dusername) && (($row['password']) == $dpword))
				{
					//echo "<h1>Match found!</h1>";
					$found++;
				}

				else
				{
					//echo "<h1>match not found!</h1>";
				}		
		
			}

			if($found!=0)
			{
				session_start();
				
				$_SESSION['the_username'] = $dusername;
				$_SESSION['message']="sign_in";
				$_SESSION['sign_in_time']="0";
				header("location: profile_page.php");
				exit();
				
			}
			

		}


	}

		



?>


</body>
</html>