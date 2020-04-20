<?php
	$host = "localhost";
	$user = "root";
	$pass = "";
	$db_name = "computicket";

	$conn = mysqli_connect($host,$user,$pass,$db_name);
	if(mysqli_connect_errno()){
			echo "Fatal Error: could not find the specified database!";
			Die("Died!");
	}
?>