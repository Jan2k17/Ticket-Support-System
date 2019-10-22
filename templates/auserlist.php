<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-header">Userliste</div>
			<div class="card-body">
				<table class="table table-striped">
					<thead>
						<tr>
							<td>E-Mail</td>
							<td>Name</td>
							<td>Admin</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					</thead>
					<tbody>
					<?php
						$sql1 = "SELECT * FROM users";
						$result1 = $conn->query($sql1);

						if ($result1->num_rows > 0) {
							while($row1 = $result1->fetch_assoc()) {
								?>
									<tr>
										<td>
											<?php echo $row1['email']; ?>
										</td>
										<td>
											<?php echo $row1['name']; ?>
										</td>
										<td>
											<?php
												if($row1['admin'] == "2"){
													echo "Ja";
												} elseif($row1['admin'] == "1"){
													echo "Ja";
												} elseif($row1['admin'] == "0"){
													echo "Nein";
												}
											?>
										</td>
										<?php
											if($_SESSION["admin"] == md5("2")){
												?>
													<td>
														<a href="?p=asetadmin&id=<?php echo $row1['id']; ?>">Adminrechte erteilen</a>
													</td>
													<td>
														<a href="?p=asetuser&id=<?php echo $row1['id']; ?>">Adminrechte entfernen</a>
													</td>
													<td>
														<a href="?p=aedituser&id=<?php echo $row1['id']; ?>">User bearbeiten</a>
													</td>
													<td>
														<a href="?p=audel&id=<?php echo $row1['id']; ?>">User l&ouml;schen</a>
													</td>
												<?php
											}
											if($_SESSION["admin"] == md5("1")){
												?>
													<td>
														<a href="?p=aedituser&id=<?php echo $row1['id']; ?>">User bearbeiten</a>
													</td>
												<?php
											}
										?>
									</tr>
								<?php
							}
						}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>