<?php
	if(!isset($_POST['submit'])){
		?>
			<form action="?p=lostpw" method="POST">
				<div class="form-group">
					<label for="email">Email:</label>
					<input type="email" name="email" class="form-control" id="email">
				</div>
				<button type="submit" name="submit" class="btn btn-primary">Passwort zusenden</button>
			</form>
		<?php
	} else {
		require_once('PHPMailer/class.phpmailer.php');
		require_once('PHPMailer/class.smtp.php');
		
		$email = $_POST['email'];
		$newpw = generatePassword(8, 2, 2, true);
		
		$pwdb = md5($newpw);
		
		$sql = "UPDATE users SET password = '$pwdb' WHERE email = '$email'";
		
		if ($conn->query($sql) === TRUE) {
			
			$mailhost       = getEmailHost();
			$mailsmtpauth   = true;
			$mailusername   = getEmailUser();
			$mailpassword   = getEmailPass();
			$mailsmtpsecure = getEmailSMTPSecure();
			$mailsmtpport	= getEmailPort();
			
			$mail = new PHPMailer(); 
			
			$mail->IsSMTP();
			$mail->Host        = "$mailhost";
			$mail->Port		   = "$mailsmtpport";
			$mail->SMTPSecure  = "$mailsmtpsecure";
			$mail->SMTPDebug   = 0;
			$mail->Debugoutput = 'html';
			$mail->SMTPAuth    = true;
			$mail->Username    = "$mailusername";
			$mail->Password    = "$mailpassword";
			
			$frommail = getEmailUser();
			$fromname = siteTitle();
			$mail->SetFrom($frommail, $fromname);
			
			$address = $email;
			$adrname = getNameByEmail($email);
			$mail->AddAddress($address, $adrname);
			
			$mail->Subject = "Passwort vergessen | ".siteTitle()."";
			$mail->Body = "Dein neues Passwort lautet: ".$newpw."";
			
			if(!$mail->Send()) {
				echo "Mailer Error: " . $mail->ErrorInfo;
			} else {
				?>
					<div class="alert alert-success">
						<strong>!ERFOLG!</strong> Dein Passwort wurde dir per E-Mail zugesandt.
					</div>
				<?php
			}
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
?>