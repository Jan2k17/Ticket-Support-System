<?php
	if(!isset($_POST['submit'])){
		?>
			<form action="?p=register" method="POST">
				<div class="form-group">
					<label for="name">Name:</label>
					<input type="text" name="name" class="form-control" id="name">
				</div>
				<div class="form-group">
					<label for="email">Email:</label>
					<input type="email" name="email" class="form-control" id="email">
				</div>
				<div class="form-group">
					<label for="pwd">Passwort:</label>
					<input type="password" name="pw1" class="form-control" id="pwd">
				</div>
				<div class="form-group">
					<label for="pwd">Passwort wiederholen:</label>
					<input type="password" name="pw2" class="form-control" id="pwd">
				</div>
				<button type="submit" name="submit" class="btn btn-primary">Registrieren</button>
			</form> 
		<?php
	} else {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$pw1 = md5($_POST['pw1']);
		$pw2 = md5($_POST['pw2']);
		
		if($name == ""){
			?>
				<div class="alert alert-danger">
					<strong>FEHLER!</strong> Der Name darf nicht leer sein.
				</div>
				
				<form action="index.php?p=register" method="POST">
					<div class="form-group">
						<label for="name">Name:</label>
						<input type="text" name="name" class="form-control" id="name">
					</div>
					<div class="form-group">
						<label for="email">Email:</label>
						<input type="email" name="email" class="form-control" id="email">
					</div>
					<div class="form-group">
						<label for="pwd">Passwort:</label>
						<input type="password" name="pw1" class="form-control" id="pwd">
					</div>
					<div class="form-group">
						<label for="pwd">Passwort wiederholen:</label>
						<input type="password" name="pw2" class="form-control" id="pwd">
					</div>
					<button type="submit" class="btn btn-primary">Registrieren</button>
				</form>
			<?php
		} elseif($pw1 != $pw2){ //PASSWORT PRÜFEN
			?>
				<div class="alert alert-danger">
					<strong>FEHLER!</strong> Das Passwort stimmt nicht &uuml;berein.
				</div>
				
				<form action="index.php?p=register" method="POST">
					<div class="form-group">
						<label for="Name">Name:</label>
						<input type="text" name="name" class="form-control" id="name">
					</div>
					<div class="form-group">
						<label for="email">Email:</label>
						<input type="email" name="email" class="form-control" id="email">
					</div>
					<div class="form-group">
						<label for="pwd">Passwort:</label>
						<input type="password" name="pw1" class="form-control" id="pwd">
					</div>
					<div class="form-group">
						<label for="pwd">Passwort wiederholen:</label>
						<input type="password" name="pw2" class="form-control" id="pwd">
					</div>
					<button type="submit" class="btn btn-primary">Registrieren</button>
				</form>
			<?php
		} else {
			//EMAILABFRAGE AUF EXISTENZ IN DER DATENBANK
			
			$sql1 = "SELECT email FROM users WHERE email = '$email'";
			$result1 = $conn->query($sql1);

			if ($result1->num_rows > 0) {
				?>
					<div class="alert alert-danger">
						<strong>!FEHLER!</strong> Die E-Mail Adresse existiert bereits.
					</div>
					
					<form action="index.php?p=register" method="POST">
						<div class="form-group">
							<label for="name">Name:</label>
							<input type="text" name="name" class="form-control" id="name">
						</div>
						<div class="form-group">
							<label for="email">Email:</label>
							<input type="email" name="email" class="form-control" id="email">
						</div>
						<div class="form-group">
							<label for="pwd">Passwort:</label>
							<input type="password" name="pw1" class="form-control" id="pwd">
						</div>
						<div class="form-group">
							<label for="pwd">Passwort wiederholen:</label>
							<input type="password" name="pw2" class="form-control" id="pwd">
						</div>
						<button type="submit" class="btn btn-primary">Registrieren</button>
					</form>
				<?php
			} else {
				$sql = "INSERT INTO users (name, email, password)
				VALUES ('$name', '$email', '$pw2')";

				if ($conn->query($sql) === TRUE) {
					?>
						<div class="alert alert-success">
							<strong>!ERFOLG!</strong> Du hast dich erfolgreich angemeldet.
						</div>
					<?php
				} else {
					echo "Error: " . $sql . "<br>" . $conn->error;
				}
			}
		}
	}
?>