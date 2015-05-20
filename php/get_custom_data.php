<!DOCTYPE html>
<html lang="en">
<head>
  <title>UwiRemoteData.com</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- start of google charts code. -->
<!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
// Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('time', 'Upload Time');
        data.addColumn('number', 'Reading');
        data.addRows([
          ['Mushrooms', 3],
          ['Onions', 1],
          ['Olives', 1],
          ['Zucchini', 1],
          ['Pepperoni', 2]
        ]);

        // Set chart options
        var options = {'title':'How Much Pizza I Ate Last Night',
                       'width':400,
                       'height':300};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
</script>
<!-- end of google charts code. -->
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
<h2 style="text-align: center;">UWI Waste Water Monitoring System</h2><br/>
    <h4>Select a Unit and a Parameter from the drop down lists below and press the Get Values button to see data.</h4>
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

	//echo "<br />";
	echo "<select  name=\"activeParameter\" id=\"S_parameter\" >";
	echo "<option >select a parameter</option>";
	while($record	= mysql_fetch_array($paraData))
	{
		echo"<option name=\"current_parameter\"  onclick=load2()>".$record['para_name']."</option>";
	}

	echo "</select>";
	mysql_close($con); 
	?>

<form action="select_unit.php" id="queryform" method="post">
<input type="submit" name="submit" value="Get Values" />
<input type="text" name="selected_unit" id="query_unit" value="select a unit." style="display: none;" />
<input type="text" name="selected_para" id="query_para" value="select a parameter." style="display: none;" >

<br/>
</form>

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
	echo "<div class=\"heading\"><h4>Table showing data for " .$para ." at " .$unit ." unit."."</h4></div>";
	echo "<table border=1 class='table-striped table-hover table-condensed'><tr> <th>Time of Upload</th><th>Date of Upload</th><th>Parameter</th><th>Value</th> <tr>";
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

<div id="chart_div"></div>




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

