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
//MySQL variables
$db_host="localhost";
$db_username="uwiPhysics";
$db_password="Ph45!c5";

//Database variables;
$db_name = "remotemonitoringDB";

	
	//The aim is to send the data from the sensor and parse it to create variables that are to be entered in the DB.
	//Slight issue on the timing format. WIll either have to write a code to reformat it or use the Current Time Function to use the serber time. 
	
	
//_________________________________________________Building the Database Variables__________________________//

	// Example String: mystring="02,uwi_waste_water_02,DATA 10/12/15,12:03:09,0.0,23.49,0.23,75.4,6.94,28.38,12.05";


	$insertString = $_GET['sData'];
	$dBData = explode(',',$insertString);

	$data = explode(' ', $insertString);	//Use PHP's inbuilt explode function to parse the comma separates string. 
	
	//echo "Data[1]: ".$data[1]; //Data1 is the data from the sensor. THe data is not separated in an Array.
	//echo"<br/>";
	
	$values = $data[1];		//We assign the string of values to a variable which we will parse for the different values. 
	
	$values = explode(',',$values); //Parse (split on commas )values into an array so we can get the individual values. 
	
	$cDate = formatSensorDate($values[0]); //Format the date the way the Database accepts. 
	
	//echo"<br/>";
	//echo $cDate;	//Print the date;
	//echo"<br/>";

	//echo $dBData[0];
	//echo"<br/>";

	//

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

	//echo $cVolts;	//Print the date;
	//echo"<br/>";

	//echo $para2;	//Print the date;
	//echo"<br/>";

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
	 	echo "Could not connect to database " ."$$db_name " ." " .mysql_error();
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

//INSERT INTO `remotemonitoringDB`.`uwienvironmentalmonitoring` (`Unit_ID`, `Unit_Name`, `Date`, `Time`, `Parameter_1`, `Parameter_2`, `Parameter_3`, `Parameter_4`, `Parameter_5`, `Cable_Volts`) VALUES ('3', 'uwi_waste_water_1', CURDATE(), CURTIME(), '28.9', '0.23', '55.79', '6.98', '28.89', '12.08');
?>

<?php
	function formatSensorDate($sensorDate)
	{
		$dateArray = explode('/',$sensorDate);
		$date = "20".$dateArray[2]."-".$dateArray[0]."-".$dateArray[1];
		return $date;
	}

	//function to print Data Values
	function print_sensor_vals()
	{
		$count = 0;
		for($count=0;$count<8;$count++)
		{
			echo "Values[".$count."] : ".$values[$count];
			echo"<br/>";
		}
	}
	
?>
</body>
</html>
