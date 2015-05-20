<!DOCTYPE html>
<html lang="en">
<head>

  <title>UwiRemoteData.com</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  
<style type="text/css">
  .jumbotron {background-color:#a7f090;}
  .btn-primary {background-color: #F2F5A9; color:black;}
  body {background-color:#dddada;}
  </style>
</head>

<body onload="load()">
<nav class="navbar navbar-inverse" >
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="uwiremotedata.html"><!--Some Image here --></a>
    </div>
    <div>
      <ul class="nav nav-tabs">
        <li class="active"><a href="uwiremotedata.html">Home</a></li>
        <li><a href="get_units.php">Units</a></li>
        <li><a href="select_unit.php">Data</a></li>
        <li><a href="support.html">Help</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container" style="width:1100px;"> <!-- Start of Conainer Div-->
	<div class="jumbotron">
    <h2 style="text-align: center;">UWI Environmental Monitoring System</h2>
    <!--	<div id="map" style="width: 950px; height: 400px; padding-right:10px;"></div> -->
	<div><p>UWI Environmental Monitoring System host information related to the UWI Treatment Plant comissioned and maintained by the Estate Management Department. We continuously monitor various parameters of environmental and social importance. Particularly, we seek to ensure our output to the environment is in accordance with the standards set up by the National Environment and Planning Agency and the Natural Resources Conservation Authority. </p>
</div>
	<br/>
	<div>Add a Unit</div>
	<form action="insert_via_url.php" method="GET">
	
		Unit ID : <input type="text" name = "unitId"/> <br/> <!-- This to be pulled from Database (JQUERY)since it is submitted by the MCU. It should dis[play as uneditable-->
 		<br/>
		Unit name : <input type="text" name = "unitName"/> <br/> <!-- This to be pulled from Database since it is submitted by the MCU. It should dis[play as uneditable-->
		 <br/>
		Latitude : <input type="text" name = "lat"/> <br/> <!-- To be added by Admibistrator -->
		 <br/>
		Longitude : <input type="text" name = "long"/> <br/> <!-- To be added by Admibistrator -->
		 <br/>
		Status : <input type="text" name = "unit_stat"/> <br/> <!--Based on Voltage or if a reading was submitted by it in the last 1 10 minutes -->
 		<br/>
		Description : <input type="text" name = "unitDesc"/> <br/> <!-- To be added by Admibistrator -->
		 <br/>
		<input type="submit" name="submit"/> <br/>
	</form>

  </div> <!--End of Jumbotron -->

	
<?php

//MySQL variables
$db_host="localhost";
$db_username="uwiPhysics";
$db_password="Ph45!c5";

//Database variables;
$db_name = "remotemonitoringDB";


if(isset($_POST["submit"]))
{


	$con = @mysql_connect("$db_host","$db_username","$db_password");
	if(!$con){
		die( "Failed to connect to MySQL: " .mysql_error());
	}
	else{
		// echo "Connection Successful!";
	}


	echo "<br />";

	//select database
	$selDb = @mysql_select_db("$db_name",$con);
	if(!$selDb){
		 echo "Could not connect to database " ."$$db_name " ." " .mysql_error();
	}else
	{
		echo"Connection to database secured!";
	}

	//Below this line will change based on what we are sumitting to the units TAble
	echo"<br />";
	//echo"Attempting POST....";
	echo "<br />";
	echo  $_POST[unitID];

	$sql= "INSERT INTO `remotemonitoringDB`.`unit` (`unit_id`, `unit_name`, `latitude`, `longitude`, `status`, `desc`) VALUES ('$_POST[unitId]','$_POST[unitName]','$_POST[lat]','$_POST[long]','$_POST[unit_stat]','$_POST[unitDesc]')";
	

	//$example  = "INSERT INTO `remotemonitoringDB`.`unit` (`unit_id`, `unit_name`, `latitude`, `longitude`, `status`, `desc`) VALUES ('5', 'uwi_test05', '77.6806', '-18.560', 'offline', 'Test Unit No. 5')";
	

	$state = @mysql_query($sql,$con);

//	if (!$state)
//{
//		 echo "New record was NOT successfully added.";
//	}
//	 else 
//	{
  //  		 echo "New record was NOT successfully added.";
//	}

	@mysql_close($con);
}
?>
</div><!-- End of Container -->
</body>
</html>
