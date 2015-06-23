<html>
<head>
<title></title>
</head>
<body>

<form action="insert_via_url.php" method="GET">

Unit ID : <input type="text" name = "unitId"/> <br/>
 <br/>
Unit name : <input type="text" name = "unitName"/> <br/>
 <br/>
Latitude : <input type="text" name = "lat"/> <br/>
 <br/>
Longitude : <input type="text" name = "long"/> <br/>
 <br/>
Status : <input type="text" name = "unit_stat"/> <br/>
 <br/>
Description : <input type="text" name = "unitDesc"/> <br/>
 <br/>
<input type="submit" name="submit"/> <br/>
</form>

<?php

//MySQL variables
$db_host="localhost";
$db_username="uwiPhysics";
$db_password="Ph45!c5";

//Database variables;
$db_name = "remotemonitoringDB";


//$con = @mysql_connect("$db_host","$db_username","$db_password");
//if(!$con){
//die( "Failed to connect to MySQL: " .mysql_error());
//}else echo "Connection Successful!";

//To see the information in the url box use a GET method. The string will look like the one below.
//http://104.237.143.204/insert_to_database.php?unitId=10&unitName=uwi_wm10&lat=18.8779&long=-77.9276&unit_stat=online&unitDesc=Test+Unit+10&submit=Submit

if(isset($_POST["submit"]))
{


	$con = @mysql_connect("$db_host","$db_username","$db_password");
	if(!$con){
		die( "Failed to connect to MySQL: " .mysql_error());
	}
	else{
		 echo "Connection Successful!";
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




</body>
</html>
