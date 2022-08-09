<?php
session_start();
require_once 'cnn.php';
require_once 'cdn.html';


//se guarda en las variables$us y $ps
$usuario = $_SESSION['usuario'];
//Query de consulta
$query = $cnnPDO->prepare('SELECT * from usuarios WHERE usuario =:usuario  ');
$query->bindParam(':usuario', $usuario);
$query->execute();
$count = $query->rowCount();
$campo = $query->fetch();
unset($query);
unset($cnnPDO);
if ($count) {
	$_SESSION['usuario'] = $campo['usuario'];

	$_SESSION['password'] = $campo['password'];
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Bienvenida</title>
	<link rel="icon" href="images/A.jpg" />
</head>

<body id="fondo">
	<style>
		#fondo {
			background-color: #e6ebdd;
		}

		#loginform {
			background-color: #FFFFFF;
			border: 1px solid #ccc;
			box-shadow: 0px 2px .5px 1px #ccc;
		}
	</style>
	<!-- Navbar -->
	<nav id="naz" class="navbar navbar-expand-lg navbar-light bg-light">
		<!-- Container wrapper -->
		<div class="container">
			<!-- Navbar brand -->
			<a class="navbar-brand me-2" href="img/RK.png">

			</a>
			<!-- Toggle button -->
			<button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarButtonsExample" aria-controls="navbarButtonsExample" aria-expanded="false" aria-label="Toggle navigation">
				<i class="fas fa-bars"></i>
			</button>

			<!-- Left links -->
			<div class="d-flex align-items-center">



				<a href="misProductos.php">
					<button type="button" class="btn btn-outline-dark me-3">
						Mis productos
					</button>
				</a>
				<a href="detalle.php">
					<button type="button" class="btn btn-outline-dark me-3">
						Detalle de mis productos
					</button>
				</a>


			</div><!-- Collapsible wrapper -->
		</div><!-- Container wrapper -->
	</nav><!-- Navbar -->
	<br>
	<div class="container">
		<div class="row">
			<div class="col-2">

			</div>
			<div class="col-8">
				<form id="loginform">
					<!-- INICIO SESION-->
					<div class="gris" class="input-group flex-nowrap">
						<span class="input-group-text" id="addon-wrapping">
							<i class="far fa-address-card">&nbsp;Inicio</i>
						</span>
					</div>
					<h2>Bienvenido, <?php echo ucwords($_SESSION['usuario']); ?>.
						<hr>Fecha y Hora: <?php
											date_default_timezone_set("America/Mexico_City");
											echo date("d-m-Y h:i a"); ?>.
						<hr> <a href="nuevo.php">
							<button type="button" class="btn btn-success me-3">
								Nuevo Producto
							</button>
						</a>

						<hr>


			</div>

			</form>
			<br>

			<div class=" offset-8 col-3">
				<a href="cerrar.php" style="letter-spacing: 3px;">
					<button type="button" class="btn btn-outline-danger" data-mdb-ripple-color="dark">Cerar Sesión <i class="ace-icon fa fa-power-off"></i></button>
				</a>
			</div>

		</div><!-- ROW -->
	</div><!-- Containerr -->
	<footer>
		<br>
		<br>
		<br>
		<hr>

		<center>
			<p>Copyright © Alberto De La Rosa Tovar</p>
		</center>
	</footer>
</body>

</html>