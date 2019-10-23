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
	
	function getNameByEmail($id){
		require("config.php");
		$sql = "SELECT * FROM users WHERE email = '$id'";
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
	
	//SMTP-DATEN AUS DATENBANK ABRUFEN
	function getEmailHost(){
		require("config.php");
		$sql = "SELECT * FROM settings WHERE setting = 'host'";
		$result = $conn->query($sql);

		$row = $result->fetch_assoc();
		
		return $row["value"];
	}
	function getEmailUser(){
		require("config.php");
		$sql = "SELECT * FROM settings WHERE setting = 'user'";
		$result = $conn->query($sql);

		$row = $result->fetch_assoc();
		
		return $row["value"];
	}
	function getEmailPass(){
		require("config.php");
		$sql = "SELECT * FROM settings WHERE setting = 'pass'";
		$result = $conn->query($sql);

		$row = $result->fetch_assoc();
		
		return $row["value"];
	}
	function getEmailSMTPSecure(){
		require("config.php");
		$sql = "SELECT * FROM settings WHERE setting = 'secure'";
		$result = $conn->query($sql);

		$row = $result->fetch_assoc();
		
		return $row["value"];
	}
	function getEmailPort(){
		require("config.php");
		$sql = "SELECT * FROM settings WHERE setting = 'port'";
		$result = $conn->query($sql);

		$row = $result->fetch_assoc();
		
		return $row["value"];
	}
	
	//Seitentitel
	function siteTitle(){
		return "Ticket-System";
	}
	
	//Copyright im Footer
	function footer(){
		return '&copy; 2019 - <a href="mailto:brauckmann.it.services@gmail.com">Jan Brauckmann</a>';
	}
	
	//ZUFALLSGENERATOR FÜR PASSWORT
	function randomPass(){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < 10; $i++) {
            $randstring = $characters[rand(0, strlen($characters))];
        }
        return $randstring;
    }
	
	function generatePassword( $passwordlength = 8,
                            $numNonAlpha = 0,
                            $numNumberChars = 0,
                            $useCapitalLetter = false ) {
		$numberChars = '123456789';
		$specialChars = '!$%&=?*-:;.,+~@_';
		$secureChars = 'abcdefghjkmnpqrstuvwxyz';
		$stack = '';
			
		// Stack für Password-Erzeugung füllen
		$stack = $secureChars;
		
		if ( $useCapitalLetter == true )
			$stack .= strtoupper ( $secureChars );
			
		$count = $passwordlength - $numNonAlpha - $numNumberChars;
		$temp = str_shuffle ( $stack );
		$stack = substr ( $temp , 0 , $count );
		
		if ( $numNonAlpha > 0 ) {
			$temp = str_shuffle ( $specialChars );
			$stack .= substr ( $temp , 0 , $numNonAlpha );
		}
			
		if ( $numNumberChars > 0 ) {
			$temp = str_shuffle ( $numberChars );
			$stack .= substr ( $temp , 0 , $numNumberChars );
		}
				
			
		// Stack durchwürfeln
		$stack = str_shuffle ( $stack );
			
		// Rückgabe des erzeugten Passwort
		return $stack;
		
	} 
?>