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
	echo "<table border=1 class='table-striped table-hover table-condensed'><tr> <th>Time</th><th>Upload Date</th><th>Parameter Name</th><th>Value</th> <tr>";
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




