<?php

	$host = 'localhost';
	$username = 'root';
	$password = '';
	$database = 'market_db';

	$conn = mysqli_connect($host, $username, $password, $database);

	if(!$conn){
		echo "Failed to connect to database";
	}

?>