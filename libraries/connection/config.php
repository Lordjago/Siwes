<?php
	require 'dbconst.php';
	error_reporting(0);
	//creating databse connection
	$db =  mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

	//Check connection
// if (!$db) {
//     die("Connection failed: " . mysqli_connect_error());
// }else{
// 	echo "Connected successfully";
// }
?>