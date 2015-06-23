<?php

	
	include 'databaseHandle.php';  //Connects to MYSQL and the Database
	
	$sqlQuery = "SELECT * FROM `remotemonitoringDB`.`googlechart` ";   // Select the data in the googlechart table of remotemonitoringDB
	$table_data = mysql_query($sqlQuery,$con);   //Con is defined as the connection variable in the database handle script.

	//New Insert
		/*
		---------------------------
		example data: Table (Chart)
		--------------------------
		weekly_task     percentage
		Sleep           30
		Watching Movie  40
		work            44
		*/

	$rows = array();		//An array variable is declared called row, it will hold the rows of the table. 
	//flag is not needed
	$flag = true;			//Boolean flag is assigned as true
	$table = array();		//An array varaible is deleared as table. not sure what it hold (echo them out)
	$table['cols'] = array(

     // Labels for your chart, these represent the column titles
     // Note that one column is in "string" format and another one is in "number" 
     // format as pie chart only required "numbers" for calculating percentage and string will be used for column title
    	array('label' => 'weekly_task', 'type' => 'string'),
    	array('label' => 'Percentage', 'type' => 'number')     
       );

	while($r = mysql_fetch_assoc($table_data)) {
		    $temp = array();
		    // the following line will be used to slice the Pie chart
		    $temp[] = array('v' => (string) $r['weekly_task']);  	//the value in quote must perfectly match the table name in the DB.
	
		    // Values of each slice
		    $temp[] = array('v' => (int) $r['percentage']); 		//the value in quote must perfectly match the table name in the DB.
		    $rows[] = array('c' => $temp);
	}

	$table['rows'] = $rows;
	$jsonTable = json_encode($table);
	echo $jsonTable; //comment to remove the json details from the page.

?>

	<html>
  <head>
    <!--Load the Ajax API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript">

    // Load the Visualization API and the piechart package.
    google.load('visualization', '1', {'packages':['corechart']});

    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(drawChart);

    function drawChart() {

      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(<?=$jsonTable?>);
      var options = {
           title: 'My Weekly Plan',
          is3D: 'true',
          width: 800,
          height: 600
        };
      // Instantiate and draw our chart, passing in some options.
      // Do not forget to check your div ID
      var chart = new google.visualization.ColumnChart(document.getElementById('chart_div')); //This line can be used to switch between the chart types by changing what follows visualization
      chart.draw(data, options);
    }
    </script>
  </head>

  <body>
    <!--this is the div that will hold the pie chart-->
    <div id="chart_div"></div>
  </body>
</html>


