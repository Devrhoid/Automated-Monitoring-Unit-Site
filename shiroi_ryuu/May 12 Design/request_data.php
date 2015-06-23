<?php
	include 'databaseHandle.php';

?>

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

