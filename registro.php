<?php
require_once 'cnn.php';
require_once 'cdn.html';
?>
<?php
//Valida que el usuario hizo clik en el Boton 
if (isset($_POST['enviar'])) {
	//Trae datos del formulario
	$usuario = $_POST['usuario'];
	$password = $_POST['password'];
	//Validar que las cajas no esten vacias
	if (!empty($usuario)  && !empty($password)) {
		//Insertar datos en la tabla de la db  
		$sql = $cnnPDO->prepare("INSERT INTO usuarios
  		(usuario, password) VALUES (:usuario,  :password   )");
		//Asignar las variables a los campos de la tabla
		$sql->bindParam(':usuario', $usuario);
		$sql->bindParam(':password', $password);

		//Ejecutar la variable $sql
		$sql->execute();
		unset($sql);
		unset($cnnPDO);
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registro</title>
	<link rel="icon" href="images/A.jpg" />
</head>

<body id="fondo">
	<style>
		#naz {
			background-color: #fff;
		}

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
				<a href="index.php">
					<button type="button" class="btn btn-primary px-3 me-2">
						Iniciar Sesion
					</button>
				</a>

			</div>
		</div><!-- Collapsible wrapper -->
		</div><!-- Container wrapper -->
	</nav>
	<!-- Navbar -->
	<br>
	<div class="container">
		<div class="row">
			<div class="col-2">

			</div>
			<div class="col-8">
				<!-- icons-->
				<div class="gris" class="input-group flex-nowrap">
					<span class="input-group-text" id="addon-wrapping">
						<i class="fas fa-key">Registrarse</i>
					</span>
				</div>

				<!-- FORM-->
				<form action="<?php $_SERVER['PHP_SELF'] ?>" autocomplete="off" class="form-horizontal" id="loginform" method="POST" role="form">

					<br>
					<!-- NAME-->
					<div class=" offset-2 col-10">
						<label for="usuario">Usuario:&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><input type="text" id="usuario" name="usuario" value="" size="37" placeholder="">
						<br>
						<br>
					</div>

					<!-- CONTRASEÑA-->
					<div class=" offset-2 col-8">
						<label for="password">Contraseña:</label>
						<input type="password" id="password" name="password" size="37" placeholder="">
						<br>
						<br>
					</div>
					<!-- BOTON CREAR-->
					<div class=" offset-5 col-7">
						<input type="submit" name="enviar" value="Crear Cuenta">
					</div>

					<br>

				</form><!-- FORM-->

			</div><!-- COL-6-->
		</div><!-- ROW -->
	</div><!-- Containerr -->
	<footer>
		<br>
		<br>
		<br>
		<hr>
		<center>
			<p>Copyright © 2022 ALBERTO DE LA ROSA.</p>
		</center>
	</footer>
</body>

</html>