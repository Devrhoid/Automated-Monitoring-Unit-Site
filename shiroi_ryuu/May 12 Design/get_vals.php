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
  body {background-color: #dddada;}
  </style>

</head> 
	

<body>

 <nav class="navbar navbar-inverse" >
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="uwiremotedata.html">UwiRemoteData</a>
    </div>
    <div>
      <ul class="nav nav-tabs">
	<li><a href="uwiremotedata.html">Home</a></li>
	<li class="active"><a href="get_units.php">Units</a></li>
        <li><a href="data.html">Data</a></li>
        <li><a href="support.html">Help</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container" style="width:1100px;"> <!-- Start of Container Div-->
<h1>Welcome to UwiRemoteData.com</h1>

<div class="jumbotron">

 <?php 

	include 'databaseHandle.php';

	$sqlQuery = "SELECT * FROM `remotemonitoringDB`.`unit` ";
	$unitsData = mysql_query($sqlQuery,$con);
	echo "<br />";
	//echo "<table border=1 class='table-striped table-hover table-condensed'><tr> <th>Unit_ID</th><th>Unit_Name</th><th>Latitude</th><th>Longitude</th><th>Status</th><th>Description</th> <tr>";
	echo "<ul>";
		while($record	= mysql_fetch_array($unitsData)){
		echo"<li>".$record['unit_name']."</li>";
	echo "</ul>";
		
	mysql_close($con);
 ?> 

	</div>
	</div>
	</body> 
	</html>
