<?php
	if(!isset($_POST['submit'])){
		?>
			<form action="?p=login" method="POST">
				<div class="form-group">
					<label for="email">Email:</label>
					<input type="email" name="email" class="form-control" id="email">
				</div>
				<div class="form-group">
					<label for="pwd">Passwort:</label>
					<input type="password" name="pass" class="form-control" id="pwd">
				</div>
				<button type="submit" name="submit" class="btn btn-primary">Anmelden</button>
			</form>
		<?php
	} else {
		$email = $_POST['email'];
		$pass = md5($_POST['pass']);
		
		$sql1 = "SELECT * FROM users WHERE email = '$email' AND password = '$pass'";
		$result1 = $conn->query($sql1);
		
		if ($result1->num_rows > 0) {
			while($row1 = $result1->fetch_assoc()) {
				$_SESSION["user"] = $email;
				$_SESSION["usern"] = $row1["name"];
				$_SESSION["admin"] = md5($row1["admin"]);
				
				?>
					<div class="alert alert-success">
						<strong>!ERFOLG!</strong> Willkommen <b><?php echo $_SESSION["usern"]; ?></b> ,<br /> Du hast dich erfolgreich angemeldet.
					</div>
				<?php
			}
		} else {
			?>
				<div class="alert alert-danger">
					<strong>!FEHLER!</strong> Die E-Mail Adresse oder Password Falsch.
				</div>
				<form action="?p=login" method="POST">
					<div class="form-group">
						<label for="email">Email:</label>
						<input type="email" name="email" class="form-control" id="email">
					</div>
					<div class="form-group">
						<label for="pwd">Passwort:</label>
						<input type="password" name="pass" class="form-control" id="pwd">
					</div>
					<button type="submit" class="btn btn-primary">Anmelden</button>
				</form>
			<?php
		}
	}
?>