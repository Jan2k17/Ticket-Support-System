<div class="card">
	<?php
		$id = $_GET['id'];
		$status = $_GET['status'];
		
		$sql1 = "SELECT * FROM tickets WHERE id = '$id'";
		$result1 = $conn->query($sql1);
		if ($result1->num_rows > 0) {
			while($row1 = $result1->fetch_assoc()) {
				?>
					<div class="card-header">
						<b><u><?php echo $row1['titel']; ?></u> | erstellt am: <u><?php echo $row1['erstellt']; ?></u></b>
					</div>
					<div class="card-body">
						<?php echo $row1['text']; ?>
					</div>
					<div class="card-footer">
						Status: <?php if($row1['status'] == "0") {echo "Offen";}else if($row1['status'] == "1"){echo "Geschlossen";} ?>
					</div>
				<?php
			}
		}
	?>
</div>
<br />
<?php
if($status != "1"){
?>
	<div class="card">
		<div class="card-body">
			<?php
				if(!isset($_POST['submit'])) {
					?>
						<form action="?p=ts&id=<?php echo $id; ?>" method="POST">
							<div class="form-group">
								<label for="txt">Antwort:</label>
								<textarea class="form-control" name="antwort" id="txt"></textarea>
							</div>
							<button type="submit" name="submit" class="btn btn-primary">absenden</button>
						</form>
					<?php
				} else {
					$antwort = $_POST['antwort'];
					$tid = $_GET['id'];
					$antwortvon = $_SESSION['user'];
					$antwortvonn = $_SESSION['usern'];
					
					$sql2 = "INSERT INTO ticketantworten (tid, antwortvon, antwort, antwortvonn)
					VALUES ('$tid', '$antwortvon', '$antwort', '$antwortvonn')";

					if ($conn->query($sql2) === TRUE) {
						?>
							<div class="alert alert-success">
								<strong>!ERFOLG!</strong> Deine Antwort auf das Ticket wurde gesendet.
							</div>
						<?php
					} else {
						echo "Error: " . $sql . "<br>" . $conn->error;
					}
				}
			?>
		</div>
	</div>
<br />
<?php
}
?>
<div class="card">
	<div class="card-body">
		<?php
			$id = $_GET['id'];
			
			$sql3 = "SELECT * FROM ticketantworten WHERE tid = '$id'";
			$result3 = $conn->query($sql3);
			if ($result3->num_rows > 0) {
				while($row3 = $result3->fetch_assoc()) {
					?>
						<div class="card-header">
							<b>Antwort von: <u><?php echo $row3['antwortvonn']; ?></u> | erstellt am: <u><?php echo $row3['erstellt']; ?></u></b>
						</div>
						<div class="card-body">
							<?php echo $row3['antwort']; ?>
						</div>
					<?php
				}
			}
		?>
	</div>
</div>