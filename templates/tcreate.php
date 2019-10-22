<?php
	if(!isset($_POST['submit'])){
		?>
			<form action="?p=tcreate" method="POST">
				<div class="form-group">
					<label for="title">Titel:</label>
					<input type="text" class="form-control" name="title" id="title" />
				</div>
				<div class="form-group">
					<label for="txt">Nachricht:</label>
					<textarea class="form-control" name="message" id="txt"></textarea>
				</div>
				<button type="submit" name="submit" class="btn btn-primary">absenden</button>
			</form>
		<?php
	} else {
		$title = $_POST['title'];
		$message = $_POST['message'];
		$ersteller = $_SESSION['user'];
		$erstellern = $_SESSION['usern'];
		
		if($title == ""){
			?>
				<div class="alert alert-danger">
					<strong>FEHLER!</strong> Der Title darf nicht leer sein.
				</div>
				<form action="?p=tcreate" method="POST">
					<div class="form-group">
						<label for="title">Titel:</label>
						<input type="text" class="form-control" name="title" id="title" />
					</div>
					<div class="form-group">
						<label for="txt">Nachricht:</label>
						<textarea class="form-control" name="message" id="txt"></textarea>
					</div>
					<button type="submit" name="submit" class="btn btn-primary">absenden</button>
				</form>
			<?php
		} elseif($message == ""){
			?>
				<div class="alert alert-danger">
					<strong>FEHLER!</strong> Die Nachricht darf nicht leer sein.
				</div>
				<form action="?p=tcreate" method="POST">
					<div class="form-group">
						<label for="title">Titel:</label>
						<input type="text" class="form-control" name="title" id="title" />
					</div>
					<div class="form-group">
						<label for="txt">Nachricht:</label>
						<textarea class="form-control" name="message" id="txt"></textarea>
					</div>
					<button type="submit" name="submit" class="btn btn-primary">absenden</button>
				</form>
			<?php
		} else {
			$sql2 = "INSERT INTO tickets (ersteller, titel, text, erstellern)
			VALUES ('$ersteller', '$title', '$message', '$erstellern')";
			if ($conn->query($sql2) === TRUE) {
				?>
					<div class="alert alert-success">
						<strong>!ERFOLG!</strong> Dein Ticket wurde erstellt.
					</div>
				<?php
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
	}
?>