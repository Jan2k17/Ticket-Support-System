<?php
	$id = $_GET['id'];
	
	$sql = "DELETE FROM tickets WHERE id = '$id'";
	
	if ($conn->query($sql) === TRUE) {
		$sql2 = "DELETE FROM ticketantworten WHERE tid = '$id'";
		
		if ($conn->query($sql2) === TRUE) {
			?>
				<div class="alert alert-success">
					<strong>!ERFOLG!</strong> Das Ticket wurde erfolgreich gel&ouml;scht.
				</div>
			<?php
		} else {
			echo "Error#TD-2: " . $sql . "<br>" . $conn->error;
		}
	} else {
		echo "Error#TD-1: " . $sql . "<br>" . $conn->error;
	}
?>