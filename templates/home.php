<div class="row">
	<div class="col-sm-6">
		<h2>Willkommen im Ticket-System</h2><br />
		<p>Hierkannst du ein Ticket erstellen um hilfe vom Team zu erhalten.</p><br />
		<?php
			if(!isset($_SESSION["user"])){
				?>
					<p><u>Bitte melde dich an um das System nutzen zu k&ouml;nnen.</u></p>
				<?php
			}
		?>
	</div>
	<div class="col-sm-6">
		<?php
			if(isset($_SESSION["user"])){
				?>
					<h2>Ticket erstellen</h2><br />
				<?php
				include("templates/tcreate.php");
			}
		?>
	</div>
</div> 