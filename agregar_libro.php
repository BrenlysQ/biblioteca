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
	<title>Registrar Libro</title>
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
					<h2>Registrar Libro</h2>
				</header>
			</div>
		</section>

		<div class="container">
			<div class="row">
				<div class="col-lg-12">

					<form id="formulario" action="proceso_regis_libro.php" method="post" class="form-horizontal">
						<input value='<?php echo $row['id'];?>'   name="id_adm"  type='hidden'/>

						<div class="form-group">
							<label class="control-label col-sm-3" for="titulo">Ingrese su Título:</label>
							<div class="col-sm-9">
								<input class="form-control" type="text"  maxlength="50"  name="titulo" id="titulo" required/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-3" for="autor">Ingrese su autor:</label>
							<div class="col-sm-9">
								<input class="form-control" type="text"  maxlength="50"  name="autor" id="autor" required/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-3" for="isbm">Ingrese su ejemplar:</label>
							<div class="col-sm-9">
								<input class="form-control" type="text"  maxlength="50"  name="isbm" id="isbm" required/>
							</div>
						</div>
					</form>

					<div class="row">
						<div class="col-lg-6"><button form="formulario" class="btn btn-lg btn-block btn-success" type='submit'> <i class="fa fa-plus"></i> Registrar</button></div>
						<div class="col-lg-6"><button form="formulario" class="btn btn-lg btn-block btn-primary" type='reset'><i class="fa fa-times"></i> Limpiar formulario</button></div>
					</div>

				</div>
			</div>
		</div>
		<?php include_once('./footer.php'); ?>
	</div>
</body>
</html>