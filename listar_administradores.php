<?php
	// session_start();
	include_once("./conexion.php");
	$conexion = conexion();

	if(!isset($_SESSION["dato_usuario"]))
	{ header('Location: index.html'); }
	
	// Estoy obteniendo los datos del usuario que almacene la variable de sesion
	if(isset($_SESSION["datos_usuario"])){
		$datos_usuario = $_SESSION['datos_usuario'];
	}
?>
<html lang="es">
<head>
	<title>Menú Administrador</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="./assets/bootstrap337/css/bootstrap.css" />
	<link rel="stylesheet" href="./assets/css/main.css"/>
</head>

<body>
	<?php include('./menu_usuario_global.php'); ?>

	<div id="main">
		<section id="top" class="one facyt">
			<div class="container">
				<header>
					<h2>Menú Administrador <i class="fa fa-cogs pull-right"></i></h2>
				</header>
			</div>
		</section>
		<section id="top" class="menu">
			<a href="./agregar_admin.php" class="boton_sub_menu">Agregar Administrador</a>
		</section>
	
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-3 col-sm-4">
				<h4>Mis Datos</h4>
				<hr>
					<!-- PARA OBTENER LAS ENTRADAS DE LA BASE DE DATOS -->
					<?php
						$dato_usuario = $_SESSION['dato_usuario']; 
						$datos_usuario = $_SESSION['datos_usuario']; 
						$id = $datos_usuario['id'];

						$sql = "SELECT * FROM admin WHERE usuario='$dato_usuario'";
						$resultado = mysqli_query($conexion,$sql) or die(mysqli_error()); 
						$row = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
					 ?>
					 <div class="panel panel-primary">
					 	<!-- <div class="panel-heading text-uppercase negritas">Datos de su Cuenta</div> -->
					 	<table class="table table-condensed">
					 		<tbody>
						 		<tr><td><span class="text-primary text-uppercase">Nombre Completo:</span></td></tr>
						 		<tr><td><?php echo $row['nombre']; ?> <?php echo $row['apellido']; ?></td></tr>
						 		<tr><td><span class="text-primary text-uppercase">Cédula:</span></td></tr>
						 		<tr><td><?php echo number_format($row['cedula'],0,',','.'); ?></td></tr>
						 		<tr><td><span class="text-primary text-uppercase">Nombre de Usuario:</span></td></tr>
						 		<tr><td><?php echo $row['usuario']; ?></td></tr>
						 		<tr><td><span class="text-primary text-uppercase">Estatus de Usuario:</span></td></tr>
						 		<tr><td><?php echo $row['estatus']; ?></td></tr>
					 		</tbody>
					 	</table>
					 	<div class="panel-footer">
					 		<a class="btn btn-primary btn-block" href="editar_admin.php"><i class="fa fa-edit"></i> Editar Mis Datos</a> 
					 		<a id="desactivar_admin" class="btn btn-danger btn-block" data-href="eliminar_admin.php"><i class="fa fa-user-times"></i> Desactivar Mi Cuenta</a> 
					 	</div>
					 </div>
				</div>
				<div class="col-lg-9 col-sm-8">
				<h4>
					Otros Usuarios Agregados al Sistema
					<!-- <span class="pull-right"><a href="#">Agregar Nuevo Administrador </a></span> -->
				</h4>
				<hr>
					 <?php
						$sql = "SELECT * FROM admin  WHERE id != '$id'";
						// $resultado = mysqli_fetch_all(mysqli_query($conexion, $sql), MYSQLI_ASSOC);
						$res = mysqli_query($conexion, $sql);
						while($l[] = $res->fetch_assoc());
					 ?>
					<div class="table-responsive">
						 <table id="dataTable" class="table table-bordered table-stripped">
						 	<thead>
						 		<tr>
						 			<th>Nombre</th>
						 			<th>Apellido</th>
						 			<th>Cédula</th>
						 			<th>Usuario</th>
						 			<th>Estatus</th>
						 		</tr>
						 	</thead>
						 	<tbody>
							 	<?php foreach ($l as $fila) { 
							 		if ($fila != NULL) {
							 	?>
							 		<tr>
							 			<td><?php echo $fila['nombre']; ?></td>
							 			<td><?php echo $fila['apellido']; ?></td>
							 			<td><?php echo number_format($fila['cedula'],0,',','.'); ?></td>
							 			<td><?php echo $fila['usuario']; ?></td>
							 			<td><?php echo $fila['estatus']; ?></td>
							 		</tr>
							 	<?php } } ?>
						 	</tbody>
						 </table>
					</div>
				</div>
			</div>
		</div>
		<?php include_once('./footer.php'); ?>
	</div>
</body>
</html>

<!-- Inicializando la dataTable -->
<script type="text/javascript">
	$(document).ready(function(){
		$('table[id=dataTable]').DataTable({
			'stateSave': true,
            "language": {
                "url": "./assets/dataTables/lang/spanish.json"
            },
            'info' : true,
        });

		/* como agregar un mensaje de confirmación a un elemento */
		$('#desactivar_admin').on('click', function(){
			var $href = $( this ).data('href');
			
			jQuery.confirm({
				theme: 'supervan',
				columnClass: 'medium',
				title: '¡Atención!',
				content: '¿Desea realmente desactivar su propia cuenta? Si lo hace no podrá acceder al sistema.',
				buttons: {
			        "Desactivar Administrador": function(){
			            jQuery.alert({theme: 'supervan', title: false, content:'Desactivando la cuenta ....'});
			            location.href = $href
			        },
			        Cancelar: function(){
			        	jQuery.alert({theme: 'supervan', title: false, content: 'No se desactivará la cuenta'});
			        }
			    }
			});
		});
	});
</script>