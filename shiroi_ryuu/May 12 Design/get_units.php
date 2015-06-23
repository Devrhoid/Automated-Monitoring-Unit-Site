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
  #table_platform{color:#F2F5A9;}
  .jumbotron {background-color:#a7f090;}
  .btn-primary {background-color: #F2F5A9; color:black;}
  body {background-color: #dddada;}
  </style>

</head> 
	

<body>

 <nav class="navbar navbar-inverse" >
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="uwiremotedata.html"><!--UwiRemoteData --></a>
    </div>
    <div>
      <ul class="nav nav-tabs">
	<li><a href="uwiremotedata.html">Home</a></li>
	<li class="active"><a href="get_units.php">Units</a></li>
        <li><a href="select_unit.php">Data</a></li>
        <li><a href="support.html">Help</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container" style="width:1100px;"> <!-- Start of Container Div-->

<div class="jumbotron">
<div id="uwi_title" style="margin:0px auto; text-align:center;color:white; background-color:red; width:950px;">
				<h2 style="text-align:center;">The University of the West Indies Mona</h2> 
		<h3>Operational Units</h3>
		</div>

 <?php //MySQL variables 
$db_host="localhost"; 
$db_username="uwiPhysics"; 
$db_password="Ph45!c5"; 
//Database variables; 
$db_name = "remotemonitoringDB"; $con = @mysql_connect("$db_host","$db_username","$db_password");
	if(!$con)
	{
		die( "Failed to connect to MySQL: " .mysql_error());
	}
	else
	{
	//	echo "Connection Successful!";
	}
	echo	"<br />";
        //select database
        $selDb = @mysql_select_db("$db_name",$con);
        if(!$selDb){
                 die("Could not connect to database " ."$$db_name " ." ".mysql_error());
        }else
        {
                echo"<br />";
	//	echo"Connection to database secured!";
        }
	$sqlQuery = "SELECT * FROM `remotemonitoringDB`.`unit` ";
	$unitsData = mysql_query($sqlQuery,$con);
	echo "<br />";
	echo "<div id=\"table_platform\">";
	echo "<table border=1 class='table-striped table-hover table-condensed'><tr> <th>Unit_ID</th><th>Unit_Name</th><th>Latitude</th><th>Longitude</th><th>Status</th><th>Description</th> <tr>";
		while($record	= mysql_fetch_array($unitsData)){
		echo"<tr class='danger'>";
		echo"<td>".$record['unit_id']."</td>";
		echo"<td>".$record['unit_name']."</td>";
		echo"<td>".$record['latitude']."</td>";
		echo"<td>".$record['longitude']."</td>";
		echo"<td>".$record['status']."</td>";
		echo"<td>".$record['desc']."</td>";
		echo"</tr>";
		}
		echo"</table>";
	echo"</div>";
		
	mysql_close($con); ?> 

	</div>
	</div>
	</body> 
	</html>
