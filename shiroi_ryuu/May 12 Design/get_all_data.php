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
  .table-have{text-align: center; margin: 0px auto;}
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
	<div id="header">
		<div id="uwi_title" style="margin:0px auto; text-align:center;color:white; background-color:red; width:950px;">
		<h2 style="text-align:center;">The University of the West Indies Mona</h2> 
		<h3>Data Table</h3>
		</div>
    		<h4 style="text-align: center;">The table below shows the last twenty readings for data from sensors in the UWI Monitoring Network.</h4>
    	</div>
<!--Php Functions to Create Tables from Data-->
<?php
	
	include 'databaseHandle.php';
	$sqlQuery = "SELECT * FROM `uwienvironmentalmonitoring` ORDER BY `Time` DESC LIMIT 0, 300"; //200 represents the number of results to display. 
	//This can be altered at any point in time. 


	$unitData = mysql_query($sqlQuery,$con);

	echo "<div class=\"row\">";
	echo "<div class=\"col-sm-6 col-md-6 col-lg-6\">";
	//echo "<div class=\"heading\"><h4>Table showing data for " .$para ." "."of unit " .$unit ."</h4>"."</div>";
	echo "<table border=1 class='table-striped table-hover table-condensed'><tr> <th>Unit ID</th> <th>Unit Name</th> <th>Upload Date</th> <th>Time (24Hrs)</th> <th> Temperature (*C)</th> <th>Conductivity (uS)</th> <th>Dissolved Oxygen (%sat)</th> <th>PH (units)</th> <th>PH (mV)</th> <th>Cable Voltage (V)</th> <tr>";
		while($record	= mysql_fetch_array($unitData))
		{
			echo"<tr class='danger'>";
			echo"<td>".$record['Unit_ID']."</td>";
			echo"<td>".$record['Unit_Name']."</td>";
			echo"<td>".$record['Date']."</td>";
			echo"<td>".$record['Time']."</td>";
			echo"<td>".$record['Parameter_1']."</td>";
			echo"<td>".$record['Parameter_2']."</td>";
			echo"<td>".$record['Parameter_3']."</td>";
			echo"<td>".$record['Parameter_4']."</td>";
			echo"<td>".$record['Parameter_5']."</td>";
			echo"<td>".$record['Cable_Volts']."</td>";
			echo"</tr>";
		}
	echo"</table>";
	mysql_close($con); 
		
?>
</div> <!-- End of table column-->
<!--
	<div class="col-sm-6 col-md-6 col-lg-6" id="graph_space"> <!--col-sm-6 col-md-6 col-lg-6--
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

