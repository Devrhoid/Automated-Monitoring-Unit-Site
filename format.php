<?php

function formatSensorDate($sensorDate)
	{
		$dateArray = explode('/',$sensorDate);
		$date = "20".$dateArray[2]."-".$dateArray[0]."-".$dateArray[1];
		return $date;
	}

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
