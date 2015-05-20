<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>UwiRemoteData.com</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  
  <!--Map Javascript-->
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
   
  
  <style type="text/css">
  .jumbotron {background-color:#a7f090;}
  .btn-primary {background-color: #F2F5A9; color:black;}
   body {background-color: #dddada;}
  </style>
</head>

<body>

<div class="container" style="width:1100px;"> <!-- Start of Container Div-->
	<div class="jumbotron">
    


<!--
		<div id="login" style="width:30%; height:220px; border: 1px solid blue; margin:0 auto; background: #00ffd2; text-align:center; padding-top:50px;" > Log In <br/>
			<form action = "index.php" method="POST">
				Username: <input type="text" name="userName" /> <br/>
				Password: <input type="password" name="pass" /><br/><br/>
				<div id="log_btn"style="margin-left:180px;" ><input class="btn-primary" type="submit" name="Login" value="Log In" /> </div><br/>
				<div id="reg_btn"style="margin-left:180px;" ><input type="submit" name="register" value="Register" /><div><br/> </form></div>
</div> 
  </div><!-- End of Class Login -->

		<div id="intro" style="margin:0px auto; text-align:center;color:;">
			<div id="uwi_title" style="margin:0px auto; text-align:center;color:white; background-color:red; width:837px;">
				<h2 style="text-align:center;">The University of the West Indies Mona</h2> 
			</div>	
		<image src="images/unitlocations.jpg" /> <!--Screen shot here-->
		<!-- <h3 style="text-align:center;">Welcome to the University of the West Indies' Waste Water Monitoring System Online Platform.</h4>	-->
		<!-- <h3 style="margin:0px auto; text-align:center;">Please click the link below to be redirected to the home page. <h3> -->
		
		<div style="margin:0px auto; text-align:center;"><h2>Waste Water Monitoring System</h2></div>

		<h3 style="margin:0px auto; text-align:center;"><a href="uwiremotedata.html">Enter Site</a>	</h3>
		
		</div>

</div> <!-- End of Jumbotron -->

</div><!-- End of Container -->
<?php

	
//include mysql connection code
//include 'connect_to_database.php';	
include 'select_database.php'; 

$db_username = "Physicsuser";
$db_pass = "9h45!c52015";

if(isset($_POST['Login']))
{

    	$username = $_POST['userName'];
	$password = $_POST['pass'];
	
	if($username == $db_username)
	{
		if($password == $db_pass)
		{
			$_SESSION['CurrentUser'] = $username;
			echo "Welcome ".$username;
			header("Location: uwiremotedata.html");//This is to be changed to uwiremotedata.html
		}
		else 
			echo "You have entered an invalid password";
	}
	elseif($username == "admin")
	{
		if($password == $db_pass)
		{
			$_SESSION['CurrentUser'] = $username;
			echo "Welcome ".$username;
			header("Location: admin_dashboard.php");//This is to be changed to uwiremotedata.html
		}
		else 
			echo "You have entered an invalid password";
		
	}
	else
		echo "Incorrect or Invalid username. Double check username or register";

	
}

	?>
<?php
$new_username;
$new_password;

if(isset($_POST['register'])){
}
//connect to database
//This is covered from the anbove include statement. 

//select users table 

//$sql = "INSERT INTO `remotemonitoringDB`.`users` (``,``,``) VALUES ('$_POST[]',)"

//insert username and password into the database table and
//Echo a message to the user or an error
?>
	
</body>
</html>

