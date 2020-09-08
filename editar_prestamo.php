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
	<title>Editar Préstamo</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="./assets/bootstrap337/css/bootstrap.css" />
	<link rel="stylesheet" href="./assets/css/main.css" />
</head>

<body>
	<?php include_once('./menu_usuario_global.php'); ?>
	
	<div id="main">
		<?php 
			$id_prestamo = $_GET['id']; 

			$sql = "SELECT * FROM prestamo WHERE id='$id_prestamo'";
			$resultado = mysqli_query($conexion,$sql) or die(mysqli_error()); 
			$row = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
		?>

		<section id="top" class="one facyt margen_header">
			<div class="container">
				<header>
					<h2>Modificar Préstamo</h2>
				</header>
			</div>
		</section>

		<div class="container">
			<div class="row">
				<div class="col-lg-12">

					<form action="proceso_edit_prestamo.php" id="editar_prestamo" method="post" class="form-horizontal">
						<input value='<?php echo $row['id'];?>'   name="id"  type='hidden'/>
						<div class="form-group">
							<div class="row">
								<label class="control-label col-sm-3" for="inicio">Fecha de Inicio</label>
								<div class="col-sm-9">
									<input class="form-control" type="text"  maxlength="50"  name="inicio" id="inicio" value='<?php echo $row['inicio'];?>'/>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="control-label col-sm-3" for="final">Fecha Final</label>
								<div class="col-sm-9">
									<input class="form-control" type="text"  maxlength="50"  name="final" id="final" value='<?php echo $row['final'];?>'/>
								</div>
							</div>
						</div>
						
					</form>
				</div>

				<div class="row">
					<div class="col-lg-12"><button form="editar_prestamo" class="btn btn-success btn-lg btn-block" type='submit'><i class="fa fa-save"></i> Almacenar Cambios</button></div>
				</div>
			</div>		
		</div>
		<?php include_once('./footer.php'); ?>
	</div>
</body>
</html>