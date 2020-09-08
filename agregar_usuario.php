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
	<title>Registrar Usuario</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="./assets/bootstrap337/css/bootstrap.css" />
	<link rel="stylesheet" href="./assets/css/main.css" />
</head>

<body>
	<?php include_once('./menu_usuario_global.php'); ?>
	<?php 
		$usuario = $_SESSION['dato_usuario'];


		$sql="SELECT * FROM admin where usuario ='$usuario'";
		$resultado = mysqli_query($conexion,$sql) or die(mysqli_error()); 
		$row = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
	?>
	<div id="main">

		<!-- <section id="top" class="one dark"> -->
		<section id="top" class="two margen_header">
			<div class="container">
				<header>
					<h2>Registrar Lector</h2>
				</header>
			</div>
		</section>

		<div class="container">
			<div class="row">
				<div class="col-lg-12">

					<form id="formulario" action="comprobar_usuario.php" method="post" class="form-horizontal">
						<input value='<?php echo $row['id'];?>'   name="id_adm"  type='hidden'/>

						<div class="form-group">
							<div class="row">
								<label class="control-label col-sm-3" for="nombre">Ingrese su Nombre:</label>
								<div class="col-sm-9">
									<input class="form-control" type="text"  maxlength="50"  name="nombre" id="nombre" required/>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="control-label col-sm-3" for="apellido">Ingrese su Apellido:</label>
								<div class="col-sm-9">
									<input class="form-control" type="text"  maxlength="50"  name="apellido" id="apellido" required/>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<div class="row">
								<label class="control-label col-sm-3" for="cedula">Ingrese su cédula:</label>
								<div class="col-sm-9">
									<input class="form-control" type="text"  maxlength="50"  name="cedula" id="cedula" required/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">								
								<label class="control-label col-sm-3" for="telefono">Ingrese su Teléfono:</label>
								<div class="col-sm-9">
									<input class="form-control" type="text"  maxlength="50"  name="telefono" id="telefono" required/>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<div class="row">
								<label class="control-label col-sm-3" for="correo">Ingrese su correo:</label>
								<div class="col-sm-9">
									<input class="form-control" type="text"  maxlength="50"  name="correo" id="correo" pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" required/>
								</div>
							</div>
						</div>

						<?php
							$sql = "SELECT c.carrera as nombre FROM `usuario` as c GROUP by c.carrera";
							$resultado = mysqli_query($conexion,$sql) or die(mysqli_error());
						?>
						<div class="form-group">
							<div class="row">
								<label class="control-label col-sm-3" for="carrera">Carrera</label>
								<div class="col-sm-9">
									<!-- <input class="form-control" type="text"  maxlength="50"  name="carrera" id="carrera" value=''/> -->
									<select class="form-control" id="carrera" name="carrera">
									<?php while ($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) { ?>
										<option <?php if($fila['nombre'] == $row['carrera']){ echo "selected"; } ?> value="<?php echo $fila['nombre']; ?>"><?php echo $fila['nombre']; ?></option>
									<?php
										}
										mysqli_close($conexion);
									?>
										<option value="">Otro valor</option>
									</select>
								</div>
							</div>
						</div>
						
					</form>
				</div>
				<div class="row">
					<div class="col-lg-6"><button form="formulario" class="btn btn-success btn-lg btn-block" type='submit'><i class="fa fa-plus"></i> Registrar</button></div>
					<div class="col-lg-6"><button form="formulario" class="btn btn-primary btn-lg btn-block" type='reset'><i class="fa fa-times"></i> Limpiar formulario</button></div>
				</div>

			</div>
		</div>
		<?php include_once('./footer.php'); ?>
	</div>
</body>
</html>

<script type="text/javascript">
	$(document).ready(function(){
		$('#carrera').on('change', function(){
			valor = $(this).val()
			console.log(valor)
			if(valor == ''){
				jQuery.confirm({
					title: 'Introduzca el nuevo valor',
					content: '<input class="form-control" type="text" maxlength="50" name="nuevo_valor" id="nuevo_valor"/>',
					theme: 'supervan',
					type: 'blue',
					typeAnimated: true,
					columnClass: 'medium',
					buttons: {
						Guardar: function(){
							btnClass: 'btn-success',
							$('#carrera').append(
								$('<option>', {
									value: $('#nuevo_valor').val(),
									text: $('#nuevo_valor').val()
								}).attr('selected', 'selected'));
						},
						Cancelar: function(){}
					}
				})
			}
		});
	});
</script>