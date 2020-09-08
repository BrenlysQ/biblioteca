<?php
session_start();
if(!isset($_SESSION["dato_usuario"]))
	{ 
		header('Location: index.html'); 
	}
	
	// Estoy obteniendo los datos del usuario que almacene la variable de sesion
	if(isset($_SESSION["datos_usuario"])){
		$datos_usuario = $_SESSION['datos_usuario'];
	}
	include('./conexion.php');
	$conexion = conexion();
?>
<html lang="es">

<head>
	<title>Registrar Préstamo</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" type="text/css" media="all" href="./assets/css/jquery-ui.min.css" />
	<link rel="stylesheet" href="./assets/bootstrap337/css/bootstrap.css" />
	<!-- <link rel="stylesheet" href="./assets/css/bootstrap-datepicker.css" /> -->
	<link rel="stylesheet" href="./assets/css/main.css" />
	<style type="text/css">
		.ui-datepicker table{ font-size: 0.7em !important; }
		.ui-datepicker .ui-datepicker-title{ font-size: 0.9em !important; }
	</style>
</head>

<body>
	<?php include_once('./menu_usuario_global.php'); ?>
	<?php 
		$usuario = $_SESSION['dato_usuario']; 

		$sql = "SELECT * FROM admin WHERE usuario = '$usuario'";
		$resultado = mysqli_query($conexion,$sql) or die(mysqli_error()); 
		$row = mysqli_fetch_array($resultado, MYSQLI_ASSOC);

		mysqli_close($conexion);
	?>
	<div id="main">
		<section id="top" class="two margen_header">
			<div class="container">
				<header>
					<h2>Registrar Préstamo</h2>
				</header>
			</div>
		</section>

		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<form id="formulario" action="proceso_agregar_prestamo.php" method="post" class="form-horizontal">
						<input value='<?php echo $row['id'];?>' name="id_adm"  type='hidden'/>
						<div class="form-group">
							<label class="control-label col-sm-3 fecha" for="libro">Libro:</label>
							<div class="col-sm-9">
								<input size="25"  value='' maxlength="50" name="libro" id="libro" class='form-control buscar_libros' placeholder="Buscar" required/>
								<input type="hidden" name="id_libro" id="id_libro" value="">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3 fecha" for="usuario">Lector:</label>
							<div class="col-sm-9">
								<input size="25"  value='' maxlength="50" name="usuario" id="usuario" class='form-control buscar_usuarios' placeholder="Buscar" required/>
								<input type="hidden" name="id_lector" id="id_lector" value="">
							</div>
						</div>
					
						<div class="form-group">
								<label class="control-label col-sm-3" for="inicio">Fecha de inicio:</label>
								<div class="col-sm-9">
									<input class="form-control fecha" type="text"  maxlength="50"  name="inicio" id="inicio" required/>
								</div>
						</div>
						<div class="form-group">
								<label class="control-label col-sm-3" for="final">Fecha de culminación:</label>
								<div class="col-sm-9">
									<input class="form-control fecha" type="text"  maxlength="50"  name="final" id="final" required/>
								</div>
						</div>						
					</form>
					<div class="row">
						<div class="col-lg-6"><button form="formulario" class="btn btn-lg btn-block btn-success" type='submit'><i class="fa fa-plus"></i> Registrar</button></div>
						<div class="col-lg-6"><button form="formulario" class="btn btn-lg btn-block btn-primary" type='reset'><i class="fa fa-times"></i> Limpiar formulario</button></div>
					</div>
				</div>
			</div>
		</div>
		<?php include_once('./footer.php'); ?>
	</div>
</body>
</html>

<script type="text/javascript" src="./assets/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="./assets/js/espanol.js"></script>
<script type="text/javascript" src="./assets/js/busquedas.js"></script>