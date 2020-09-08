<?php
	session_start();
	if(!isset($_SESSION["dato_usuario"])){ header('Location: index.html'); }
	if(isset($_SESSION["datos_usuario"])){ $datos_usuario = $_SESSION['datos_usuario']; }
	include_once("./conexion.php");
	$conexion = conexion();
?>
<html lang="es">

<head>
	<title>Lectores Registrados</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="./assets/bootstrap337/css/bootstrap.css" />
	<link rel="stylesheet" href="./assets/css/main.css" />
</head>

<body>
	<?php include('./menu_usuario_global.php'); ?>

	<div id="main">
		<section id="top" class="one facyt">
			<div class="container">
				<header>
					<h2>Listado de Lectores Registrados <i class="fa fa-user pull-right"></i></h2>
				</header>
			</div>	
		</section>
		<section id="top" class="menu">
			<a href="./agregar_usuario.php" class="boton_sub_menu">Agregar Lector</a>		
		</section>
	
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<!-- PARA OBTENER LAS ENTRADAS DE LA BASE DE DATOS -->
					<?php
						$sql = "SELECT usuario.* , admin.nombre as nombre_adm from usuario , admin WHERE usuario.id_adm=admin.id";
						// $resultado = mysqli_fetch_all(mysqli_query($conexion, $sql), MYSQLI_ASSOC);
						$res = mysqli_query($conexion, $sql);
						while($resultado[] = $res->fetch_assoc());
					 ?>
					<div class="table-responsive">
					 <table id="dataTable" class="table table-bordered table-stripped">
					 	<thead>
					 		<tr>
					 			<th>Nombre</th>
					 			<th>Apellido</th>
					 			<th>Cédula</th>
					 			<!-- <th>Teléfono</th> -->
					 			<!-- <th>Correo</th> -->
					 			<th>Carrera</th>
					 			<th>Fecha de Ingreso</th>
					 			<!-- <th>Ingresado Por</th> -->
					 			<th>Estatus</th>
					 			<th class="text-center"><i class="fa fa-cogs"></i></th>
					 		</tr>
					 	</thead>
					 	<tbody>
					 	<?php foreach ($resultado as $fila) {
					 		if ($fila != NULL) {
					 	?>
					 		<tr>
					 			<td><?php echo $fila['nombre']; ?></td>
					 			<td><?php echo $fila['apellido']; ?></td>
					 			<td><?php echo number_format($fila['cedula'],0,',','.'); ?></td>
					 			<!-- <td><?php echo $fila['telefono']; ?></td> -->
					 			<!-- <td><?php echo $fila['correo']; ?></td> -->
					 			<td><?php echo $fila['carrera']; ?></td>
					 			<td><?php echo $fila['registro']; ?></td>
					 			<!-- <td><?php echo $fila['nombre_adm']; ?></td> -->
					 			<td><?php echo $fila['estatus']; ?></td>
					 			<td class="text-center">
					 				<a class="btn btn-sm btn-primary" href="editar_usuario.php?id=<?php echo $fila['id']; ?>"><i class="fa fa-edit"></i></a> 
					 				<!-- <a class="btn btn-sm btn-danger" href="eliminar_usuario.php?id=<?php echo $fila['id']; ?>"><i class="fa fa-trash"></i></a> -->

					 				<?php if ($fila['estatus'] == 'ACTIVO') { ?>
					 					<a id="desactivar_lector" data-href="eliminar_usuario.php?id=<?php echo $fila['id']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-times"></i></a>
					 				<?php }else{ ?>
					 					<a id="activar_lector" data-href="activar_user.php?id=<?php echo $fila['id']; ?>" class="btn btn-sm btn-success" class="btn btn-sm btn-success"><i class="fa fa-check"></i></a>
					 				<?php } ?>
					 				<a href="#"
					 					data-nombre="<?php echo $fila['nombre'].' '.$fila['apellido']; ?>"
					 					data-cedula="<?php echo number_format($fila['cedula'],0,',','.'); ?>"
					 					data-telefono="<?php echo $fila['telefono']; ?>"
					 					data-correo="<?php echo $fila['correo']; ?>"
					 					data-carrera="<?php echo $fila['carrera']; ?>"
					 					data-registro="<?php echo $fila['registro']; ?>"
					 					data-nombreadmin="<?php echo $fila['nombre_adm']; ?>"
					 					data-estatus="<?php echo $fila['estatus']; ?>"
					 				class="btn btn-sm btn-info boton_info"><i class="fa fa-info"></i></a>
					 			</td>
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

<script type="text/javascript">
	$(document).ready(function(){
		$('#dataTable').DataTable({
			'stateSave': true,
            "language": {
                "url": "./assets/dataTables/lang/spanish.json"
            },
            'info' : true,
            columnDefs: [{ orderable: false, targets: [-1] }]
        });

		$('.boton_info').on('click', function(){
			var nombre = $(this).data('nombre')
			var telefono = $(this).data('telefono')
			var cedula = $(this).data('cedula')
			var correo = $(this).data('correo')
			var carrera = $(this).data('carrera')
			var registro = $(this).data('registro')
			var nombreadmin = $(this).data('nombreadmin')
			var estatus = $(this).data('estatus')

	        jQuery.alert({
	        	theme: 'supervan',
				columnClass: 'medium',
	        	title: 'Información de "'+nombre+'"',
	        	content: '<table style="background-color: white;" class="table"><tbody><tr><th>Nombre:</th><td>'+nombre+'</td></tr><tr><th>Cédula:</th><td>'+cedula+'</td></tr><tr><th>Teléfono:</th><td>'+telefono+'</td></tr><tr><th>Correo:</th><td>'+correo+'</td></tr><tr><th>Carrera:</th><td>'+carrera+'</td></tr><tr><th>Fecha de Ingreso:</th><td>'+registro+'</td></tr><tr><th>Ingresado por:</th><td>'+nombreadmin+'</td></tr><tr><th>Estatus:</th><td>'+estatus+'</td></tr></tbody></table>',
	        })
		});

		$('a[id="desactivar_lector"]').on('click', function(){
			var $href = $( this ).data('href');

			jQuery.confirm({
				theme: 'supervan',
				columnClass: 'medium',
				title: '¡Atención!',
				content: '¿Desea realmente DESACTIVAR este lector? Si lo hace, el mismo no podrá solicitar prestamos.',
				buttons: {
			        "Desactivar Lector": function(){
			        	btnClass: 'btn-success',
			            jQuery.alert({theme: 'supervan', title: false, content:'Desactivando la cuenta del lector ....'});
			            location.href = $href;
			        },
			        Cancelar: function(){
			        	jQuery.alert({theme: 'supervan', title: false, content: 'No se efectuaran cambios sobre la cuenta del lector'});
			        }
			    }
			});
		});

		$('a[id="activar_lector"]').on('click', function(){
			var $href = $( this ).data('href');

			jQuery.confirm({
				theme: 'supervan',
				columnClass: 'medium',
				title: '¡Atención!',
				content: '¿Desea realmente ACTIVAR este lector?',
				buttons: {
			        "Activar Lector": function(){
			        	btnClass: 'btn-success',
			            jQuery.alert({theme: 'supervan', title: false, content:'Activando la cuenta del lector ....'});
			            location.href = $href;
			        },
			        Cancelar: function(){
			        	jQuery.alert({theme: 'supervan', title: false, content: 'No se efectuaran cambios sobre la cuenta del lector'});
			        }
			    }
			});
		});
	});
</script>