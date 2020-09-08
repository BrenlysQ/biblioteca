<?php
session_start();
if(!isset($_SESSION["dato_usuario"]))
		{ 
			header('Location: index.html'); 
		}
	
	// Estoy obteniendo los datos del usuario que almacene la variable de sesion
	if(isset($_SESSION["datos_usuario"])){
		$datos_usuario = $_SESSION['datos_usuario'];
		// unset($_SESSION['datos_usuario']);
	}
	include('./conexion.php');
	$conexion = conexion();
?>
<html lang="es">

<head>
	<title>Registrar Administrador</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="./assets/bootstrap337/css/bootstrap.css" />
	<link rel="stylesheet" href="./assets/css/main.css" />

	<script type="text/javascript" src="./assets/dataTables/jquery223.js"></script>
</head>

<body>
	<?php include_once('./menu_usuario_global.php'); ?>
	<?php 
		$usuario = $_SESSION['dato_usuario'];

		$sql="SELECT * FROM admin where usuario ='$usuario'";
		$resultado = mysqli_query($conexion,$sql) or die(mysqli_error()); 
		$row = mysqli_fetch_array($resultado, MYSQLI_ASSOC);

		mysqli_close($conexion);
	?>
	<div id="main">
		<section id="top" class="two margen_header">
			<div class="container">
				<header>
					<h2>Registrar Administrador <i class="fa fa-cogs pull-right"></i></h2>
				</header>
			</div>
		</section>

		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<form action="proceso_agregar_admin.php" name="formulario" id="formulario" method="post" class="form-horizontal">

						<div class="form-group">
							<label class="control-label col-sm-3" for="nombre">Ingrese su nombre:</label>
							<div class="col-sm-9">
								<input class="form-control" type="text"  maxlength="50"  name="nombre" id="nombre" required/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3" for="apellido">Ingrese su apellido:</label>
							<div class="col-sm-9">
								<input class="form-control" type="text"  maxlength="50"  name="apellido" id="apellido" required/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-3" for="cedula">Ingrese su cédula:</label>
							<div class="col-sm-9">
								<input class="form-control" type="text"  maxlength="50"  name="cedula" id="cedula" required/>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="usuario">Ingrese su usuario:</label>
							<div class="col-sm-9">
								<input class="form-control" type="text"  maxlength="50"  name="usuario" id="usuario" required/>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="contrasena">Ingrese su contraseña:</label>
							<div class="col-sm-9">
								<input class="form-control" type="password"  maxlength="50"  name="contrasena" id="contrasena" required/>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="contrasena">Repita su contraseña:</label>
							<div class="col-sm-9">
								<input class="form-control" type="password"  maxlength="50"  name="contrasena_rep" id="contrasena_rep" required/>
							</div>
						</div>
					</form>
				</div>
						
				<div class="col-lg-6"><button form="formulario" class="btn btn-lg btn-block btn-success" type='submit'><i class="fa fa-user-plus"></i> Registrar</button></div>
				<div class="col-lg-6"><button form="formulario" class="btn btn-lg btn-block btn-primary" type='reset'><i class="fa fa-times"></i> Borrar</button></div>
			</div>
		</div>
		<?php include_once('./footer.php'); ?>
	</div>
</body>
</html>