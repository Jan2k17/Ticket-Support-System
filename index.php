<?php
	if(!file_exists("config/config.php")){
		header('Location: install.php');
	}else{
		require_once("config/config.php");
		require_once("config/functions.php");
	}
	session_start();
	
	/*error_reporting(E_ALL);
	ini_set('display_errors', 1);*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo siteTitle(); ?></title>
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
	<h1><?php echo siteTitle(); ?></h1>
	<p></p> 
</div>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <a class="navbar-brand" href="index.php">Ticket-System</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
	<div class="collapse navbar-collapse" id="collapsibleNavbar">
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" href="index.php">Startseite</a>
			</li>
			<?php
				if(!isset($_SESSION['user'])){
					?>
						<li class="nav-item">
							<a class="nav-link" href="?p=login">Anmelden</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="?p=register">Registrieren</a>
						</li>
					<?php
				} else {
					?>
						<li class="nav-item">
							<a class="nav-link" href="?p=dashboard">Dashboard</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="?p=tcreate">Ticket erstellen</a>
						</li>
					<?php
					if(getAdmin($_SESSION['user']) != "0"){
						?>
							<!-- Dropdown -->
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
									Admin
								</a>
								<div class="dropdown-menu">
									<a class="dropdown-item" href="?p=atlist">Tickets anzeigen</a>
									<a class="dropdown-item" href="?p=auserlist">User anzeigen</a>
								</div>
							</li>
						<?php
					}
					?>
						<li class="nav-item">
							<a class="nav-link" href="?p=logout">Abmelden</a>
						</li>
					<?php
				}
			?>
		</ul>
	</div>  
</nav>

<div class="container" style="margin-top:30px">
	<div class="row">
		<div class="col">
			<?php
				if($_GET['p'] != ""){
					if(file_exists("templates/".$_GET['p'].".php")){
						if(isset($_SESSION['user'])){
							$user = $_SESSION['user'];
							include("templates/".$_GET['p'].".php");
						} else {
							include("templates/".$_GET['p'].".php");
						}
					} else {
						include("templates/404.php");
					}
				} else {
					if(isset($_SESSION['user'])){
						$user = $_SESSION['user'];
						include('templates/home.php');
					} else {
						include('templates/home.php');
					}
				}
			?>
		</div>
	</div>
</div>
<br />
<div class="jumbotron text-center" style="margin-bottom:0">
	<p>
		<?php echo footer(); ?>
	</p>
</div>

</body>
</html>
