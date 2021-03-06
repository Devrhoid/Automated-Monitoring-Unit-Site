<!DOCTYPE html>
<html lang="en">
<head>
  <title>UwiRemoteData.com</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  
  <!--Map Javascript .table-striped {border: 1px solid black; margin: 0px auto;} -->
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
  
  <style type="text/css">
  
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
      <a class="navbar-brand" href="uwiremotedata.html"><!-- UwiRemoteData --> </a>
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
		<h3 style="text-align: center;">UWI Environmental Monitoring System</h3><br/>
    		<h4>Select a Unit and a parameter from the drop down lists below and press the Get Values button to see data.</h4>
    	<!--Create Drop down for Units-->
    	<?php
	
	include 'databaseHandle.php';
	
	$sqlQuery = "SELECT * FROM `remotemonitoringDB`.`unit` ";
	$unitsData = mysql_query($sqlQuery,$con);

	echo "<br />";
	echo "<select  name=\"activeUnit\" id=\"S_unit\" >";
	echo "<option >select a unit </option>";
	while($record	= mysql_fetch_array($unitsData))
	{
		echo"<option name=\"current_unit\"  onclick=load()>".$record['unit_name']."</option>";
	}

	echo "</select>";

	//Drop down for Parameters

	$sqlQuery = "SELECT * FROM `remotemonitoringDB`.`parameter` ";
	$paraData = mysql_query($sqlQuery,$con);

	echo "<select  name=\"activeParameter\" id=\"S_parameter\" >";
	echo "<option >select a parameter</option>";
	while($record	= mysql_fetch_array($paraData))
	{
		echo"<option name=\"current_parameter\"  onclick=load2()>".$record['para_name']."</option>";
	}
	echo "</select>";
	mysql_close($con); 
	?>
	<br/>

	<div class="col-sm-6">
	<br/>

	<form action="select_unit.php" id="queryform" method="post">
		<input type="text" name="selected_unit" id="query_unit" value="select a unit." style="display: none;" />
		<input type="text" name="selected_para" id="query_para" value="select a parameter." style="display: none;" >
		<input type="submit" name="submit" value="Get Values" />
	</form>

<!--Php Functions to Create Tables from Data-->
<?php
	
	include 'databaseHandle.php';

	$unit = $_POST["selected_unit"];
	$para = $_POST["selected_para"];
	//	echo "$unit";
	
	//SQL Query Ran will depend on which Parameter is in the para_selected div
	if ($para == 'Temperature')
	{
		$sqlQuery = "SELECT    `uwienvironmentalmonitoring`.`Date`, `uwienvironmentalmonitoring`.`Time`, `uwienvironmentalmonitoring`.`Parameter_1` ,`parameter`.`para_name` FROM  `unit` ,  `parameter` ,  `uwienvironmentalmonitoring` 
WHERE `unit`.`unit_name` =  '$unit' &&`uwienvironmentalmonitoring`.`Unit_Id` = `unit`.`unit_id` && `parameter`.`para_name` = '$para' ORDER BY `uwienvironmentalmonitoring`.`Time`
LIMIT 0 , 300";
	}
	else if ($para == '')
	{
		$sqlQuery = "SELECT    `uwienvironmentalmonitoring`.`Date`, `uwienvironmentalmonitoring`.`Time`, `uwienvironmentalmonitoring`.`Parameter_1` FROM  `uwienvironmentalmonitoring` ";	
	}
	else if($para == '')
	{
		
	}
	else if($para == '')
	{
		
	}
	else if($para == '')
	{
		
	}
	
	$unitData = mysql_query($sqlQuery,$con);

	echo "<div class=\"row\">";
	echo "<div class=\"col-sm-6 col-md-6 col-lg-6\">";
	echo "<div class=\"heading\"><h4>Table showing data for " .$para ." "."of unit " .$unit ."</h4>"."</div>";
	echo "<table border=1 class='table-striped table-hover table-condensed'><tr> <th>Time</th> <!-- <th>Upload Date</th><th>Parameter Name</th> --><th>Value</th> <tr>";
		while($record	= mysql_fetch_array($unitData))
		{
			echo"<tr class='danger'>";
			echo"<td>".$record['Time']."</td>";
			//echo"<td>".$record['upDate']."</td>";
			//echo"<td>".$record['parameter_id']."</td>";
			//echo"<td>".$record['para_name']."</td>";
			echo"<td>".$record['val']."</td>";
			//echo"<td>".$record['alert']."</td>";
			//echo"<td>".$record['desc']."</td>";
			echo"</tr>";
		}
	echo"</table>";
	mysql_close($con); 
		
?>
</div> <!-- End of table column-->

	<div class="col-sm-6 col-md-6 col-lg-6" id="graph_space"> <!--col-sm-6 col-md-6 col-lg-6-->
	<h4>Graph showing the readings over the last 24 hours.</h4>
	 </div> <!-- End of graph column-->
</div><!-- End of row-->

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

