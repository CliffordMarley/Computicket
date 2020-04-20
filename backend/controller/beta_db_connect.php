<?php
	$server = "localhost";
	$username = "root";
	$password = "";
	$database_name = "computicket_beta";

	$conn2 = mysqli_connect($server,$username,$password,$database_name);
	if(mysqli_connect_errno()){
			Die("Fatal Error: could not find the specified database!");
	}
?>