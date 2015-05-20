<?php //MySQL variables 
	$db_host="localhost"; 
	$db_username="uwiPhysics"; 
	$db_password="Ph45!c5"; 
	//Database variables; 
	$db_name = "remotemonitoringDB"; 
	
	$con = @mysql_connect("$db_host","$db_username","$db_password");
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
                 die("Could not connect to database " ."$db_name " ." ".mysql_error());
        }else
        {
                echo"<br />";
	//	echo"Connection to database secured!";
        }
?>
