<?php
//MySQL variables
$db_host="localhost";
$db_username="uwiPhysics";
$db_password="Ph45!c5";

//Database variables;
$db_name = "remotemonitoringDB";

//http://104.237.143.204/insert_to_database.php?unitId=10&unitName=uwi_wm10&lat=18.8779&long=-77.9276&unit_stat=online&unitDesc=Test+Unit+10&submit=Submit


$uId = $_GET['unitId']; 
$uName = $_GET['unitName']; 
$ulat = $_GET['lat']; 
$ulong = $_GET['long']; 
$ustatus = $_GET['unit_stat']; 
$uDesc = $_GET['unitDesc'];


echo $uId;


        $con = @mysql_connect("$db_host","$db_username","$db_password");
        if(!$con){
                die( "Failed to connect to MySQL: " .mysql_error());
        }
        else
		{
            echo "Connection Successful!";
        }


        $selDb = @mysql_select_db("$db_name",$con);
	if(!$selDb)
	{
	 echo "Could not connect to database " ."$$db_name " ." " .mysql_error();
        }else
        {
         echo "Connection to database secured!";
        }

	//$uId = $_GET['unitId'];
	//$uName = $_GET['unitName'];
	//$ulat = $_GET['lat'];
	//$ulong = $_GET['long'];
	//$ustatus = $_GET['unit_stat'];
	//$uDesc = $_GET['unitDesc'];



        $sql= "INSERT INTO `remotemonitoringDB`.`unit` (`unit_id`, `unit_name`, `latitude`, `longitude`, `status`, `desc`) VALUES ('$uId','$uName','$ulat','$ulong','$ustatus','$uDesc')";
        $state = @mysql_query($sql,$con);

	@mysql_close($con);
		//http://http//104.237.143.204/insert_to_database.php?unitId=12&unitName=uwi_wm12&lat=18.7579&long=-77.7643&unit_stat=online&unitDesc=Test+Unit+12&submit=Submit;
?>





