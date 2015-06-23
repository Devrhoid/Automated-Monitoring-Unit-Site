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
  .table-striped {border: 1px solid black; margin: 0px auto;}
  .jumbotron {background-color:#a7f090;}
  .btn-primary {background-color: #F2F5A9; color:black;}
  .heading {margin: 0px auto;}
  body {background-color: #dddada;}
  </style>
</head>

<body ><!-- onload="load();"-->
<nav class="navbar navbar-inverse" >
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="uwiremotedata.html">UwiRemoteData</a>
    </div>
    <div>
      <ul class="nav nav-tabs">
        <li><a href="uwiremotedata.html">Home</a></li>
        <li><a href="get_units.php">Units</a></li>
        <li class='active'><a href="data.html">Data</a></li>
        <li><a href="support.html">Help</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container" style="width:1100px;"> <!-- Start of Container Div-->
	<div class="jumbotron">

    <h3>Select a Unit and a parameter from the drop down lists below and press the Get Values button to see data.</h3>
    <!-- <h3>Fetch data for the selected unit by pressing the "Get Values" button below.</h3> -->

<!--Create Drop down for Units-->
    	<?php
	
	include 'databaseHandle.php';
	
	$sqlQuery = "SELECT * FROM `remotemonitoringDB`.`unit` ";
	$unitsData = mysql_query($sqlQuery,$con);

	echo "<br />";
	echo "<select  name=\"activeUnit\" id=\"S_unit\" >";
	while($record	= mysql_fetch_array($unitsData))
	{
		echo"<option name=\"current_unit\"  onclick=load()>".$record['unit_name']."</option>";
	}

	echo "</select>";

//Drop down for Parameters

	$sqlQuery = "SELECT * FROM `remotemonitoringDB`.`parameter` ";
	$paraData = mysql_query($sqlQuery,$con);

	echo "<br />";
	echo "<select  name=\"activeParameter\" id=\"S_parameter\" >";
	while($record	= mysql_fetch_array($paraData))
	{
		echo"<option name=\"current_parameter\"  onclick=load2()>".$record['para_name']."</option>";
	}

	echo "</select>";
	mysql_close($con); 
	?>

<br/>
<br/><br/>

<form action="select_unit.php" id="queryform" method="post">
<input type="text" name="selected_unit" id="query_unit" value="select a unit."/>
<input type="text" name="selected_para" id="query_para" value="select a parameter.">
<input type="submit" name="submit" value="Get Values" />
<br/>
</form>

	<table style="border:1px solid black;">
	<tr><th>Date</th><th>Time</th><th>PH</th><th>Conductivity</th><th>Temperature</th><th>B.O.D.</th> </tr>
	<tr><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
	</table>

<!--Php Functions to Create Tables from Data-->

<?php

	include 'databaseHandle.php';

	$unit = $_POST["selected_unit"];
	$para = $_POST["selected_para"];
	//	echo "$unit";
	
	$sqlQuery = "SELECT    `values`.`Time`, `values`.`upDate`, `parameter`.`para_name` ,  `values`.`val`
FROM  `unit` ,  `parameter` ,  `values` 
WHERE `unit`.`unit_name` =  '$unit' &&`values`.`unit_id` = `unit`.`unit_id` &&  `parameter`.`para_id` =  `values`.`parameter_id` && `parameter`.`para_name` = '$para' ORDER BY `values`.`Time`
LIMIT 0 , 300";
	$unitData = mysql_query($sqlQuery,$con);


	echo "<br />";
	echo "<div class=\"heading\"><h4>Table showing data for " .$para ." "."of unit " .$unit ."</h4></div>";
	echo "<table border=1 class='table-striped table-hover table-condensed'><tr> <th>Time</th><th>Upload Date</th><th>Parameter Name</th><th>Value</th> </tr>";
		while($record	= mysql_fetch_array($unitData))
		{
			echo"<tr class='danger'>";
			echo"<td>".$record['Time']."</td>";
			echo"<td>".$record['upDate']."</td>";
			echo"<td>".$record['para_name']."</td>";
			echo"<td>".$record['val']."</td>";
			echo"</tr>";
		}
	echo"</table>";
	mysql_close($con); 
		
?>






<script type="text/javascript">
//Javascript will be used to get the value of the sHTML element that is selected. 
//A JS function will set the innerHTML of the textbox input. 
//Need to accurately place and call the JS function / script. 
//When the button is pressed, the value will be passed to a query that will then produce the table on the page in a div below the button.
function load()
{
	var myval = document.getElementById("S_unit"); //Active/Selected unit is stored in a JS variable myval
	document.getElementById("query_unit").value = (myval.value);  //Set input textfield text as myval
}

function load2()
{
	var myval = document.getElementById("S_parameter"); //Active/Selected unit is stored in a JS variable myval
	document.getElementById("query_para").value = (myval.value);  //Set input textfield text as myval
}
</script>
</div><!-- End of Container -->
</body>
</html>

