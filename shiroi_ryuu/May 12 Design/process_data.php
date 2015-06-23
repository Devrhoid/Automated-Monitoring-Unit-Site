<html>
<head>
<title></title>
</head>
<body>

<form action="process_data.php" method="GET">

Unit ID : <input type="text" name = "unitId"/> <br/>
 <br/>
Unit name : <input type="text" name = "unitName"/> <br/>
 <br/>
Time : <input type="text" name = "time"/> <br/>
 <br/>
Date : <input type="text" name = "date"/> <br/>
 <br/>
Parameter 1 : <input type="text" name = "para_1"/> <br/>
 <br/>

Parameter 2 : <input type="text" name = "para_2"/> <br/>                                         
 <br/>

Parameter 3 : <input type="text" name = "para_3"/> <br/>
 <br/>

Parameter 4 : <input type="text" name = "para_4"/> <br/>
 <br/>

Parameter 5 : <input type="text" name = "para_5"/> <br/>
 <br/>

Cable Volts : <input type="text" name = "cVolts"/> <br/>
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

	$uId = $_GET['unitId']; 	//Unit ID pulled from Entry box
	$uName = $_GET['unitName'];	//Unit Name pulled from Entry box.

	$mystring="DATA 10/12/15,12:03:09,23.49,0.0,0.23,75.4,6.94,28.38,12.05"; //Sample comma separated string. 
	$dbString=$uId.",".$uName.",".$mystring; //Sample Database String
	
	//The aim is to send the data from the sensor and parse it to create variables that are to be entered in the DB.
	//Slight issue on the timing format. WIll either have to write a code to reformat it or use the Current Time Function to use the serber time. 
	

	echo $dbString; 	//Print the Database String.
	echo"<br/>";

	$dBData = explode(',',$dbString);
	echo $dBData[1];
	echo"<br/>";


	echo "<br/>";
	$data = explode(' ', $dbString);	//Use PHP's inbuilt explode function to parse the comma separates string. 
	echo "Data[1]: ".$data[1];
	echo"<br/>";


	$values = $data[1];
	//the same can be done with the Time value from the sensor to create a time in the expected format. 
	
	//Time formatting

		
	$values = explode(',',$values);

	echo "Unit ID: ".$dbString[0];
	echo"<br/>";
	
	echo "Unit Name: ".$dBData[1];
	echo"<br/>";
	
	$cDate = formatSensorDate($values[0]);
	
	echo "Date: ".$cDate;
	echo "<br/>";

	//Print each variable from the Array String resulting from the parsing with explode
	echo "Time: ".$values[1];
	echo "<br/>";

	echo "Parameter_1: ".$values[2];
	echo "<br/>";

	echo "Parameter_2: ".$values[3];
	echo "<br/>";

	echo "Parameter_3: ".$values[4];
	echo "<br/>";

	echo "Parameter_4: ".$values[5];
	echo "<br/>";

	echo "Parameter_5: ".$values[6];
	echo "<br/>";

	echo "Parameter_6: ".$values[7];
	echo "<br/>";

	echo "Cable Voltage: ".$values[8];
	echo "<br/>";

	//formatSensorDate($values[0]); //Working!!

/*

$uId = $_GET['unitId']; 
$uName = $_GET['unitName'];
$date = $_GET['date'];
$time = "CURTIME()";
$para1 = $_GET['para_1'];
$para2 = $_GET['para_2'];
$para3 = $_GET['para_3'];
$para4 = $_GET['para_4'];
$para5 = $_GET['para_5'];
$cVolts = $_GET['cVolts'];

	$con = @mysql_connect("$db_host","$db_username","$db_password");
        if(!$con){
                die( "Failed to connect to MySQL: " .mysql_error());
        }
        else
		{
            echo "Connection Successful!";
        }


        $selDb = @mysql_select_db("$db_name",$con);
	if(!$selDb)
	{
	 echo "Could not connect to database " ."$$db_name " ." " .mysql_error();
        }else
        {
         echo "Connection to database secured!";
        }

	$sql= "INSERT INTO `remotemonitoringDB`.`uwienvironmentalmonitoring` (`Unit_Id`, `Unit_Name`, `Date`, `Time`, `Parameter_1`,`Parameter_2`,`Parameter_3`, `Parameter_4`, `Parameter_5`,`Cable_Volts`) VALUES ('$uId','$uName','$date','$time','$para1','$para2','$para3','$para4','$para5','$cVolts')";
        $state = @mysql_query($sql,$con);

	@mysql_close($con);
*/
//INSERT INTO `remotemonitoringDB`.`uwienvironmentalmonitoring` (`Unit_ID`, `Unit_Name`, `Date`, `Time`, `Parameter_1`, `Parameter_2`, `Parameter_3`, `Parameter_4`, `Parameter_5`, `Cable_Volts`) VALUES ('3', 'uwi_waste_water_1', CURDATE(), CURTIME(), '28.9', '0.23', '55.79', '6.98', '28.89', '12.08');
?>

<?php
	function formatSensorDate($sensorDate)
	{
		$dateArray = explode('/',$sensorDate);
		$date = "20".$dateArray[2]."-".$dateArray[0]."-".$dateArray[1];
		return $date;
	}
?>
</body>
</html>
