<?php
	$id = $_GET['id'];
	
	$sql = "DELETE FROM users WHERE id = '$id'";
	
	if ($conn->query($sql) === TRUE) {
		?>
			<div class="alert alert-success">
				<strong>!ERFOLG!</strong> Der User wurde erfolgreich gel&ouml;scht.
			</div>
		<?php
	} else {
		echo "Error#UD-1: " . $sql . "<br>" . $conn->error;
	}
?>