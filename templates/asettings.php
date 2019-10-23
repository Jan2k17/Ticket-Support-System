<?php
	if(!isset($_POST['submit'])){
		?>
			<form action="?p=asettings" method="POST">
				<div class="form-group">
					<label for="mailhost">SMTP-Host:</label>
					<input type="text" name="mailhost" value="<?php echo getEmailHost(); ?>" class="form-control" id="mailhost">
				</div>
				<div class="form-group">
					<label for="mailuser">SMTP-User:</label>
					<input type="text" name="mailuser" value="<?php echo getEmailUser(); ?>" class="form-control" id="mailuser">
				</div>
				<div class="form-group">
					<label for="mailpass">SMTP-Passwort:</label>
					<input type="password" name="mailpass" value="<?php echo getEmailPass(); ?>" class="form-control" id="mailpass">
				</div>
				<div class="form-group">
					<label for="mailsecure">SMTP Server SSL/TLS:</label>
					<select class="form-control" id="mailsecure">
						<option name="mailsecure" value="">ohne</option>
						<option name="mailsecure" value="tls">STARTTLS</option>
						<option name="mailsecure" value="ssl">SSL</option>
					</select>
				</div>
				<div class="form-group">
					<label for="mailport">SMTP-Port:</label>
					<input type="number" name="mailport" value="<?php echo getEmailPort(); ?>" class="form-control" id="mailport">
				</div>
				<button type="submit" name="submit" class="btn btn-primary">speichern</button>
			</form>
		<?php
	} else {
		$mailhost = $_POST['mailhost'];
		$mailuser = $_POST['mailuser'];
		$mailpass = $_POST['mailpass'];
		$mailsecure = $_POST['mailsecure'];
		$mailport = $_POST['mailport'];
		
		$sql1 = "UPDATE settings SET value = '$mailhost' WHERE setting = 'host'; ";
		
		if ($conn->query($sql1) === TRUE) {
			?>
				<div class="alert alert-success">
					<strong>!ERFOLG!</strong> SMTP-Host wurde gespeichert.
				</div>
			<?php
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		
		$sql2 = "UPDATE settings SET value = '$mailuser' WHERE setting = 'user'; ";
		
		if ($conn->query($sql2) === TRUE) {
			?>
				<div class="alert alert-success">
					<strong>!ERFOLG!</strong> SMTP-User wurde gespeichert.
				</div>
			<?php
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		
		$sql3 = "UPDATE settings SET value = '$mailpass' WHERE setting = 'pass'; ";
		
		if ($conn->query($sql3) === TRUE) {
			?>
				<div class="alert alert-success">
					<strong>!ERFOLG!</strong> SMTP-Passwort wurde gespeichert.
				</div>
			<?php
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		
		$sql4 = "UPDATE settings SET value = '$mailsecure' WHERE setting = 'secure'; ";
		
		if ($conn->query($sql4) === TRUE) {
			?>
				<div class="alert alert-success">
					<strong>!ERFOLG!</strong> SMTP-Secure wurde gespeichert.
				</div>
			<?php
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		
		$sql5 = "UPDATE settings SET value = '$mailport' WHERE setting = 'port'; ";
		
		if ($conn->query($sql5) === TRUE) {
			?>
				<div class="alert alert-success">
					<strong>!ERFOLG!</strong> SMTP-Port wurde gespeichert.
				</div>
			<?php
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		
	}
?>