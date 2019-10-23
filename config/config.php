<?php
	$host = "localhost";
	$user = "ticket";
	$pass = "x1alpha";
	$data = "ticket";
	$port = "3306";
	
	$conn = new mysqli($host, $user, $pass, $data, $port);
	
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
?>