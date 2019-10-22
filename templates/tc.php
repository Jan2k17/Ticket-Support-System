<?php
	$id = $_GET['id'];
	
	$sql = "UPDATE tickets SET status = '1' WHERE id = '$id'; ";
	
	if ($conn->query($sql) === TRUE) {
		?>
			<div class="alert alert-success">
				<strong>!ERFOLG!</strong> Das Ticket wurde erfolgreich geschlossen.
			</div>
		<?php
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
?>