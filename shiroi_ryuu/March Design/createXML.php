<?php

//MySQL variables
$db_host="localhost";
$db_username="uwiPhysics";
$db_password="Ph45!c5";
$db_name = "remotemonitoringDB";

$con = @mysql_connect("$db_host","$db_username","$db_password");
if(!$con){
die( "Failed to connect to MySQL: " .mysql_error());
}

//select database
$sel = @mysql_select_db("$db_name",$con);
if(!$sel)
{
    echo ("Connection to database failed " .mysql_error());
}

function parseToXML($htmlStr){

        $xmlStr = str_replace('<','&lt;',$htmlStr);
        $xmlStr = str_replace('>','&gt;',$htmlStr);
        $xmlStr = str_replace('"','&quot;',$htmlStr);
        $xmlStr = str_replace('"','&#39;',$htmlStr);

        return $xmlStr;
}

        // Select all rows form database table
        $query = "SELECT * FROM `remotemonitoringDB`.`unit` WHERE 1";
        $result = @mysql_query($query);

        if(!$result){
                die('Invalid Query: ' .mysql_error());
        }
		
		//Link to new Page/
        header("Content-type :text/xml;");

        //Start XML File echo parent node

        echo '<markers>';

        //Iterate through the rows printing XM nodes for each
		
		while($row = @mysql_fetch_assoc($result)){

                //Add to XML Document Node

                echo '<marker ';
                echo 'unitID="' . parseToXML($row['unit_id']) . '" ';
                echo 'unit_Name="' . parseToXML($row['unit_name']) . '" ';
                echo 'Lat="' . $row['latitude'] . '" ';
                echo 'Long="' . $row['longitude'] . '" ';
                echo 'status="' . $row['status'] . '" ';
                echo 'Description="' . $row['desc'] . '" ';
                echo '/>';
        }

        //End of XML File
        echo '</markers>';
@mysql_close($con);
?>
