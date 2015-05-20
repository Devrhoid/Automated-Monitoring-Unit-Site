<html>
<head>
<title></title>
</head>
<body>

<form action="process_sensor_data.php" method="GET">

Data String : <input type="text" name = "sData" style="width:1000px;"/> <br/>
 <br/>
<input type="submit" name="submit" style="width:200px;"/> <br/>
</form>

<?php
	include 'databaseHandle.php';
	include 'format.php';

	$insertString = $_GET['sData'];
	$dBData = explode(',',$insertString);

	$data = explode(' ', $insertString);	
	
	$values = $data[1];
	
	$values = explode(',',$values); 

	$cDate = formatSensorDate($values[0]); 
		
	$uId = $dBData[0]; 
	$uName = $dBData[1];
	$date = $cDate;
	$time = $values[1];
	$para1 = $values[3];
	$para2 = $values[4];
	$para3 = $values[5];
	$para4 = $values[6];
	$para5 = $values[7];
	$cVolts = $values[8];

	
	$con = @mysql_connect("$db_host","$db_username","$db_password");
        if(!$con){
                die( "Failed to connect to MySQL: " .mysql_error());
        }
        else
	{
            //echo "Connection Successful!";
        }


        $selDb = @mysql_select_db("$db_name",$con);
	if(!$selDb)
	{
	 	echo "Could not connect to database " .mysql_error();
        }
	else
        {
         	//echo "Connection to database secured!";
        }

	$sql= "INSERT INTO `remotemonitoringDB`.`uwienvironmentalmonitoring` (`Unit_Id`, `Unit_Name`, `Date`, `Time`, `Parameter_1`,`Parameter_2`,`Parameter_3`, `Parameter_4`, `Parameter_5`,`Cable_Volts`) VALUES ('$uId','$uName','$date','$time','$para1','$para2','$para3','$para4','$para5','$cVolts')";
        $insert = @mysql_query($sql,$con);

	if(!$insert)
	{
	 	echo "Could not connect to database insert values"." " .mysql_error();
        }
	else
        {
	         echo "Values succesfully inserted!";
        }

	@mysql_close($con);

?>
	
</body>
</html>
