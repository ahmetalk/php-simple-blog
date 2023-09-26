<?php 
	

$db_name = "blog";
$db_user = "root";
$db_pass = "";
$conn = "";

try{
	$conn = mysqli_connect("localhost", $db_user, $db_pass, $db_name);
}
catch(mysqli_sql_exception){
	echo "Error! Could not connect!";
}

if ($conn){
	//echo "connected";
}





?>