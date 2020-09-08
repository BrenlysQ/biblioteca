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
	<title>Editar Administrador</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="./assets/bootstrap337/css/bootstrap.css" />
	<link rel="stylesheet" href="./assets/css/main.css" />
</head>

<body>
	<?php include_once('./menu_usuario_global.php'); ?>

	<div id="main">
		<?php 
			$dato_usuario = $_SESSION['dato_usuario'];

			$sql = "SELECT * FROM admin WHERE usuario='$dato_usuario'";
			$resultado = mysqli_query($conexion,$sql) or die(mysqli_error()); 
			$row = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
		?>

		<section id="top" class="one facyt margen_header">
			<div class="container">
				<header>
					<h2>Modificar Datos Administrador<br><small><?php echo $row['apellido'];?> <?php echo $row['nombre'];?></small></h2>
				</header>
			</div>
		</section>

		<div class="container">
			<div class="row">
				<div class="col-lg-12">

					<form action="proceso_edit_admin.php" id="editar_admin" method="post" class="form-horizontal">

						<div class="form-group">
							<div class="row">
								<label class="control-label col-sm-3" for="nombre">Nombre</label>
								<div class="col-sm-9">
									<input class="form-control" type="text"  maxlength="50"  name="nombre" id="nombre" value='<?php echo $row['nombre'];?>'/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<label class="control-label col-sm-3" for="apellido">Apellido</label>
								<div class="col-sm-9">
									<input class="form-control" type="text"  maxlength="50"  name="apellido" id="apellido" value='<?php echo $row['apellido'];?>'/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<label class="control-label col-sm-3" for="cedula">Cédula</label>
								<div class="col-sm-9">
									<input class="form-control" type="text"  maxlength="50"  name="cedula" id="cedula" value='<?php echo $row['cedula'];?>'/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<label class="control-label col-sm-3" for="usuario">Nombre de Usuario</label>
								<div class="col-sm-9">
									<input class="form-control" type="text"  maxlength="50"  name="usuario" id="usuario" value='<?php echo $row['usuario'];?>'/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<label class="control-label col-sm-3" for="contrasena">Clave de Acceso</label>
								<div class="col-sm-9">
									<input class="form-control" type="password"  maxlength="50"  name="contrasena" id="contrasena" value='<?php echo $row['contrasena'];?>'/>
								</div>
							</div>
						</div>
						
					</form>
				</div>
				<div class="row">
					<div class="col-lg-12"><button form="editar_admin" class="btn btn-success btn-lg btn-block" type='submit'><i class="fa fa-save"></i> Almacenar Cambios</button></div>
				</div>
			</div>		
		</div>
		<?php include_once('./footer.php'); ?>
	</div>
</body>
</html>