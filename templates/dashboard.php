<div class="card">
	<div class="card-header">offene Tickets</div>
	<div class="card-body">
		<table class="table table-striped">
			<thead>
				<tr>
					<td>Titel</td>
					<td>erstellt</td>
					<td></td>
				</tr>
			</thead>
			<tbody>
			<?php
				$sql1 = "SELECT * FROM tickets WHERE ersteller = '$user' AND status = '0'";
				$result1 = $conn->query($sql1);

				if ($result1->num_rows > 0) {
					while($row1 = $result1->fetch_assoc()) {
						?>
							<tr>
								<td>
									<?php echo $row1['titel']; ?>
								</td>
								<td>
									<?php echo $row1['erstellt']; ?>
								</td>
								<td>
									<a href="?p=ts&id=<?php echo $row1['id']; ?>&status=<?php echo $row1['status']; ?>">ansehen</a> | <a href="?p=tc&id=<?php echo $row1['id']; ?>">schliessen</a>
								</td>
							</tr>
						<?php
					}
				}
			?>
			</tbody>
		</table>
	</div>
</div>
<br />
<div class="card">
	<div class="card-header">geschlossene Tickets</div>
	<div class="card-body">
		<table class="table table-striped">
			<thead>
				<tr>
					<td>Titel</td>
					<td>erstellt</td>
					<td></td>
				</tr>
			</thead>
			<tbody>
			<?php
				$sql2 = "SELECT * FROM tickets WHERE ersteller = '$user' AND status = '1'";
				$result2 = $conn->query($sql2);

				if ($result2->num_rows > 0) {
					while($row2 = $result2->fetch_assoc()) {
						?>
							<tr>
								<td>
									<?php echo $row2['titel']; ?>
								</td>
								<td>
									<?php echo $row2['erstellt']; ?>
								</td>
								<td>
									<a href="?p=ts&id=<?php echo $row2['id']; ?>&status=<?php echo $row2['status']; ?>">ansehen</a>
								</td>
							</tr>
						<?php
					}
				}
			?>
			</tbody>
		</table>
	</div>
</div>