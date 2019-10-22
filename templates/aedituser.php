<?php
	if(!isset($_POST["submit"])){
		$id = $_GET["id"];
		?>
			<form action="?p=aedituser&id=<?php echo $id; ?>" method="POST">
				<div class="form-group">
					<label for="name">Name:</label>
					<input type="text" name="name" value="<?php echo getName($id); ?>" class="form-control" id="name">
				</div>
				<div class="form-group">
					<label for="email">Email:</label>
					<input type="email" name="email" value="<?php echo getEmail($id); ?>" class="form-control" id="email">
				</div>
				<div class="form-group">
					<label for="pwd">Passwort:</label>
					<input type="password" name="pw1" class="form-control" id="pwd">
				</div>
				<div class="form-group">
					<label for="pwd">Passwort wiederholen:</label>
					<input type="password" name="pw2" class="form-control" id="pwd">
				</div>
				<button type="submit" name="submit" class="btn btn-primary">speichern</button>
			</form> 
		<?php
	} else {
		$id = $_GET["id"];
		$name = $_POST["name"];
		$email = $_POST["email"];
		$pw1 = $_POST["pw1"];
		$pw2 = $_POST["pw2"];
		
		if($pw1 == ""){
			
			$sql = "UPDATE users SET name = '$name', email = '$email' WHERE id = '$id'; ";
			
			if ($conn->query($sql) === TRUE) {
				?>
					<div class="alert alert-success">
						<strong>!ERFOLG!</strong> Der User wurde bearbeitet.
					</div>
				<?php
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
			
		} elseif($pw1 != ""){
			if($pw1 == $pw2){
				$pass = md5($pw2);
				$sql = "UPDATE users SET name = '$name', email = '$email', password = '$pass' WHERE id = '$id'; ";
				
				if ($conn->query($sql) === TRUE) {
					?>
						<div class="alert alert-success">
							<strong>!ERFOLG!</strong> Der User wurde bearbeitet.
						</div>
					<?php
				} else {
					echo "Error: " . $sql . "<br>" . $conn->error;
				}
			} else {
				?>
					<div class="alert alert-danger">
						<strong>FEHLER!</strong> Es ist ein Fehler aufgetreten,<br />bitte versuche es erneut.
					</div>
				<?php
			}
		} else {
			?>
				<div class="alert alert-danger">
					<strong>FEHLER!</strong> Es ist ein Fehler aufgetreten,<br />bitte versuche es erneut.
				</div>
			<?php
		}
	}
?>