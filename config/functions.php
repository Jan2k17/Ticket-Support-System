<?php
	//Abfrage nach Admin-Status
	function getAdmin($user){
		require("config.php");
		$sqla = "SELECT * FROM users WHERE email = '$user'";
		$resulta = $conn->query($sqla);

		$rowa = $resulta->fetch_assoc();
		
		return $rowa["admin"];
	}
	
	function getName($id){
		require("config.php");
		$sql = "SELECT * FROM users WHERE id = '$id'";
		$result = $conn->query($sql);

		$row = $result->fetch_assoc();
		
		return $row["name"];
	}
	
	function getEmail($id){
		require("config.php");
		$sql = "SELECT * FROM users WHERE id = '$id'";
		$result = $conn->query($sql);

		$row = $result->fetch_assoc();
		
		return $row["email"];
	}
	
	//Seitentitel
	function siteTitle(){
		return "Ticket-System";
	}
	
	//Copyright im Footer
	function footer(){
		return '&copy; 2019 - <a href="mailto:brauckmann.it.services@gmail.com">Jan Brauckmann</a>';
	}
?>