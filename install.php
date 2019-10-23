<!DOCTYPE html>
<html lang="en">
<head>
	<title>Ticket-System Installer</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	
	<script src="js/jquery.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	
	<script src="js/tinymce/tinymce.min.js"></script>
	<script>tinymce.init({selector:'textarea'});</script>
</head>
<body>

<div class="jumbotron text-center" style="margin-bottom:0">
	<h1>Ticket-System Installer</h1>
	<p></p> 
</div>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <a class="navbar-brand" href="index.php">Ticket-System Installer</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
	<div class="collapse navbar-collapse" id="collapsibleNavbar">
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" href="install.php">Install</a>
			</li>
		</ul>
	</div>  
</nav>

<div class="container" style="margin-top:30px">
	<div class="row">
		<div class="col">
			<?php
			if(is_writable("config")){
				if($_GET['step'] == ""){
					?>
						<h2>Willkommen zum <u>Ticket-System Installer</u></h2>
						<br />
						<p>Bitte die Datenbank-Verbindung angeben:</p>
						<br />
						<form action="?step=2" method="POST">
							<div class="form-group">
								<label for="host">Host:</label>
								<input type="text" name="dbhost" value="localhost" class="form-control" id="host">
							</div>
							<div class="form-group">
								<label for="user">Username:</label>
								<input type="text" name="dbuser" value="root" class="form-control" id="user">
							</div>
							<div class="form-group">
								<label for="pass">Passwort:</label>
								<input type="password" name="dbpass" class="form-control" id="pass">
							</div>
							<div class="form-group">
								<label for="data">Datenbank:</label>
								<input type="text" name="dbdata" value="ticketsystem" class="form-control" id="data">
							</div>
							<button type="submit" name="submit" class="btn btn-primary">weiter</button>
						</form>
					<?php
				}elseif($_GET['step'] == "2"){
					if(isset($_POST["submit"])){
						
						$dbhost = $_POST["dbhost"];
						$dbuser = $_POST["dbuser"];
						$dbpass = $_POST["dbpass"];
						$dbdata = $_POST["dbdata"];
						
						//$zeile = "\r\n";
						$zeile = "<?php\r\n
	\$host = \"$dbhost\";\r\n
	\$user = \"$dbuser\";\r\n
	\$pass = \"$dbpass\";\r\n
	\$data = \"$dbdata\";\r\n
	\$port = \"3306\";\r\n
	\r\n
	\$conn = new mysqli(\$host, \$user, \$pass, \$data, \$port);\r\n
	\r\n
	if (\$conn->connect_error) {\r\n
		die(\"Connection failed: \" . \$conn->connect_error);\r\n
	}\r\n
?>";
						file_put_contents("config/config.php", $zeile);
						?>
							<p>Datei wurde erstellt!</p>
							<h2><a href="?step=3">Datenbank initialisieren</a></h2>
						<?php
					}
				}elseif($_GET['step'] == "3"){
					require('config/config.php');
					
					$sql1 = "CREATE TABLE `ticketantworten` (
  `id` int(11) NOT NULL,
  `tid` int(255) NOT NULL,
  `antwortvon` varchar(255) NOT NULL,
  `antwort` longtext NOT NULL,
  `erstellt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `antwortvonn` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `ticketantworten`
  ADD PRIMARY KEY (`id`);
  
ALTER TABLE `ticketantworten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;";
					
					if ($conn->query($sql1) === TRUE) {
						?>
							<div class="alert alert-success">
								<strong>!ERFOLG!</strong> Tabelle <u>ticketantworten</u> wurde erstellt.
							</div>
						<?php
					} else {
						echo "Error: " . $sql . "<br>" . $conn->error;
					}
					
					$sql2 = "CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `ersteller` varchar(255) NOT NULL,
  `titel` varchar(255) NOT NULL,
  `text` longtext NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `erstellt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `erstellern` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);";
					
					if ($conn->query($sql2) === TRUE) {
						?>
							<div class="alert alert-success">
								<strong>!ERFOLG!</strong> Tabelle <u>tickets</u> wurde erstellt.
							</div>
						<?php
					} else {
						echo "Error: " . $sql . "<br>" . $conn->error;
					}
					
					$sql3 = "CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `admin` enum('0','1','2') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;";
					
					if ($conn->query($sql3) === TRUE) {
						?>
							<div class="alert alert-success">
								<strong>!ERFOLG!</strong> Tabelle <u>users</u> wurde erstellt.
							</div>
						<?php
					} else {
						echo "Error: " . $sql . "<br>" . $conn->error;
					}
					
					$sql4 = "CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `setting` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;";
					
					if ($conn->query($sql4) === TRUE) {
						?>
							<div class="alert alert-success">
								<strong>!ERFOLG!</strong> Tabelle <u>settings</u> wurde erstellt.
							</div>
						<?php
					} else {
						echo "Error: " . $sql . "<br>" . $conn->error;
					}
					
					$sql5 = "INSERT INTO `settings` (`id`, `setting`, `value`) VALUES
(1, 'host', 'smtp.mail-provider.com'),
(2, 'user', 'email@mail-provider.com'),
(3, 'pass', '1234567890'),
(4, 'secure', 'tls'),
(5, 'port', '587');";
					
					if ($conn->query($sql5) === TRUE) {
						?>
							<div class="alert alert-success">
								<strong>!ERFOLG!</strong> Tabelleninhalt f&uuml;r <u>settings</u> wurde erstellt.
							</div>
						<?php
					} else {
						echo "Error: " . $sql . "<br>" . $conn->error;
					}
					
					?>
						<h2><a href="?step=4">weiter</a></h2>
					<?php
				}elseif($_GET['step'] == "4"){
					?>
						<h2>Admin-Benutzer erstellen</h2>
						
						<form action="?step=5" method="POST">
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
							<button type="submit" name="submit" class="btn btn-primary">weiter</button>
						</form> 
					<?php
				}elseif($_GET['step'] == "5"){
					require('config/config.php');
					
					$name = $_POST['name'];
					$email = $_POST['email'];
					$pw1 = md5($_POST['pw1']);
					$pw2 = md5($_POST['pw2']);
					$admin = "2";
					
					if($name == ""){
						?>
							<div class="alert alert-danger">
								<strong>FEHLER!</strong> Der Name darf nicht leer sein.
							</div>
							
							<form action="?step=5" method="POST">
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
							
							<form action="?step=5" method="POST">
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
						$sql = "INSERT INTO users (name, email, password, admin)
						VALUES ('$name', '$email', '$pw2', '$admin')";
						if ($conn->query($sql) === TRUE) {
							?>
								<div class="alert alert-success">
									<strong>!ERFOLG!</strong> Benutzer wurde erstellt.
								</div>
								<p><a href="?step=6">weiter</a></p>
							<?php
						} else {
							echo "Error: " . $sql . "<br>" . $conn->error;
						}
					}
				}elseif($_GET['step'] == "6"){
					?>
						<h2>Installation erledigt.</h2>
						<p>Vielen dank das du das <u>Ticket-System</u> von <a href="mailto:brauckmann.it.services@gmail.com">Jan Brauckmann</a> verwendest.<br />
						Du kannst dich nun im Ticket-System einloggen und loslegen:<br />
						<a href="index.php">LOSLEGEN</a></p>
					<?php
				}
			} else {
				?>
					<div class="alert alert-danger">
						<strong>FEHLER!</strong> Der Ordner <u>config/</u> ist nicht beschreibbar.<br />
						Bitte &auml;ndere die Rechte auf <u>777</u>.
					</div>
				<?php
			}
			?>
		</div>
	</div>
</div>
<br />
<div class="jumbotron text-center" style="margin-bottom:0">
	<p>
		&copy; 2019 - <a href="mailto:brauckmann.it.services@gmail.com">Jan Brauckmann</a>
	</p>
</div>

</body>
</html>
