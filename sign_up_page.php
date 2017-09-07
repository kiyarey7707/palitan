<!-- When people sign up, make a new database for that person then a table for their books on sale-->

<?php
session_start();
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
  	<script type="text/javascript" src="sign_up_page.js"></script>
  	

</head>

<body style="background-color: #200000;">


<div class="container-fluid" style="margin: auto; max-width: 1200px;">

	<div class="row" style="background-color: #0066ff; padding-top:30px; padding-bottom: 40px; border-bottom: 1px solid blue;" >

		<div class="col-md-3" style="padding-left: 100px;"><a href="home_page.php"><img src="http://logos.textgiraffe.com/logos/logo-name/Kenneth-designstyle-boots-m.png" width="190px" height="80px"></a>
		</div>
		  
		<div class="col-md-6" style="padding-top: 30px;">
			<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Search Book by Title or ISBN" name="search" required/>
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

	<div class="row" style="text-align: center; padding-top: 30px;"><h2><font color="silver" face="ubuntu">Sign up now! </font></h2><h4><font color="gold">Start selling books to your fellow students!</font></h4></div>

	<div class="row" style="text-align: center; padding-top: 20px; padding-bottom: 430px; padding-right: 450px; padding-left: 450px; ">
	

		<form name="info" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="validateForm()">

			<div class="form-group"><input type="text/password" name="email" placeholder="Email" class="form-control" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required></div>
			<div class="form-group"><input type="text/password" name="uname" placeholder="Username" class="form-control" id="uname" pattern="[A-Za-z0-9]{8,}" required></div>
			<div class="form-group"><input type="password" name="pword" placeholder="Password" class="form-control" id="pword" pattern=".{4,}" required></div>
			<div class="form-group"><input type="password" name="cpword" placeholder="Confirm Password" class="form-control" id="cpword" required></div>
			<div class="form-group"><input  type="submit" class="btn btn-success btn-block" value="Sign up" required></div>

		</form>

	

		
	</div>

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

		$message=$email=$uname=$pword=$cpword="";
		$messageR=$emailR=$unameR=$pwordR=$cpwordR="";
		$try="";
		$counter=0;

		
		
		if($_SERVER["REQUEST_METHOD"]=="POST")
		{
			if(empty($_POST['email']))
			{
				$email="";
			
				$emailR="<br>Email address is required!";
			}

			

			else
			{
				$email=$_POST['email'];
				$counter++;
			}

			if(empty($_POST['uname']))
			{
				$uname="";
		
				$unameR="<br>Username is required!";
			}

			else
			{
				$uname=test_input($_POST['uname']);
				$_SESSION['the_username']=$_POST['uname'];
				$counter++;
				
			}	


			if(empty($_POST['pword']))
			{
				$pword="";
				
				$pwordR="<br>Password is required!";
			}

			else
			{
				$pword=test_input($_POST['pword']);
				$counter++;
				
				
				if(empty($_POST['cpword']))
				{
					$cpword="";
					$pwordR="<br>You did not confirm your password!";
				}


				else if($_POST['pword'] != $_POST['cpword'])
				{
					$cpwordR="The two passwords do not match!<br>";
				}

				else
				{
					$cpword=test_input($_POST['cpword']);
					$counter++;
				}	
			}


		}
		
		if($counter>0)   	//>0 for now
		{

			include("connection_elements.php");

			$sql="SELECT email, username, password FROM users";

			$result=$conn->query($sql);

			$lcounter=0;
			$pword_counter=0;
			$account_msg="";
			$msg="";

			$pword_message="";
			$email_message="";

			if($result->num_rows > 0)
			{

				while($row=$result->fetch_assoc())
				{
					if(($row['username'] == $uname))
					{
						$account_msg="account already exists!<br>";
						$lcounter++;
					}


					if($row['password']== $pword)
					{
						$pword_counter++;
						$pword_message="Password is taken!<br>";
					}

					if($row['email'] == $email)
					{
						$email_message="email is already taken!<br>";
					}



					
				}



				if($lcounter>0 )			//when the new account entered already exists
				{	
					echo "<h1>". $account_msg." ".$pword_message. " ". $email_message. "</h1><br>";
				
				}
				else
				{
					$nsql="INSERT INTO users (username,email, password) VALUES ('$uname','$email','$pword')" ;
					if($conn->query($nsql) === TRUE)
					{
						echo "values are entered successfully!<br>";
						$_SESSION['conn_message']="";

						(int)$_SESSION['times']=0;
						$_SESSION['message']="sign_up";
						header("location: profile_page.php");
						
					}
				}
			}

			else 		//if no user has been registered! this will be the very first user of this website
			{
				$nsql="INSERT INTO users (username,email, password) VALUES ('$uname','$email','$pword')" ;
					if($conn->query($nsql) === TRUE)
					{
						echo "values are entered successfully!<br>";
						$_SESSION['conn_message']="";

						(int)$_SESSION['times']=0;
						$_SESSION['message']="sign_up";
						header("location: profile_page.php");
						
					}
			}

		}

		function test_input($data)
		{
			$data=trim($data);
			$data=stripslashes($data);
			$data=htmlspecialchars($data);
			return $data;
		}




			
			//$email=mysqli_real_escape_string($conn, $_POST['email']);
			//$uname=mysqli_real_escape_string($conn, $_POST['uname']);
			//$pword=mysqli_real_escape_string($conn, $_POST['pword']);


			
			

			/*include("connection_elements.php");
			$connect=new mysqli($server, $user, $password);
			$nsql="CREATE DATABASE $uname";

			if($connect->query($nsql) === TRUE)
			{
				echo "Database created!";
			}

			else
			{
				echo "database creation failed ". $connect->error;
			}


			mysqli_close($connect);

			include("connection_elements.php");

			$new_connect=new mysqli($server, $user, $password, $uname);

			
			
			$new_sql="CREATE TABLE my_libros (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, title VARCHAR(100) NOT NULL, subject VARCHAR(4) NOT NULL, numero VARCHAR(3) NOT NULL, reg_date TIMESTAMP )";

			if($new_connect->query($new_sql) === TRUE)
			{
				echo "table my_libros created";
			}

			else
			{
				echo "table my_books not created";
			}*/






			





			/*$email=mysqli_real_escape_string($conn, $_POST['email']);
			$uname=mysqli_real_escape_string($conn, $_POST['uname']);
			$pword=mysqli_real_escape_string($conn, $_POST['pword']);
			$cpword=mysqli_real_escape_string($conn, $_POST['cpword']);

			$sql = "INSERT INTO Joiners (Email, Username, Password, Confirm)
				VALUES ('$email','$uname', '$pword','$cpword')";

				if ($conn->query($sql) === TRUE) {
   				 echo "New record created successfully";

			} else {
    			echo "Error: " . $sql . "<br>" . $conn->error;
				}

			
			header("location: profile_page.php");*/
			
		


		

	?>	


<h1 id="display"></h1></div>



</body>
</html>

