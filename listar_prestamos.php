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
	include_once("./conexion.php");
	$conexion = conexion();
	$estatus = "VENCIDO";
?>
<html lang="es">

<head>
	<title>Préstamos Registrados</title>
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
					<h2><i class="fa fa-bookmark-o pull-right"></i> Listado de Préstamos Registrados</h2>
				</header>
			</div>
		</section>
		<section id="top" class="menu">
			<a href="./agregar_prestamo.php">Realizar Préstamo</a>
		</section>
	
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<!-- PARA OBTENER LAS ENTRADAS DE LA BASE DE DATOS -->
					<?php
						$sql = "SELECT prestamo.* , admin.nombre as nombre_adm , usuario.nombre as nombre_usuario , libro.titulo as nombre_libro  from prestamo , admin , usuario , libro WHERE prestamo.id_adm=admin.id AND prestamo.id_usuario=usuario.id AND prestamo.id_libro=libro.id AND prestamo.estatus != '$estatus'";
						// $resultado = mysqli_fetch_all(mysqli_query($conexion, $sql), MYSQLI_ASSOC);
						$res = mysqli_query($conexion, $sql);
						while($resultado[] = $res->fetch_assoc());
					 ?>
					 <div class="table-responsive">
						 <table id="dataTable" class="table table-bordered table-stripped">
						 	<thead>
						 		<tr>
						 			<th>Lector</th>
						 			<th>Libro</th>
						 			<th>Fecha de Inicio</th>
						 			<th>Fecha de Culminación</th>
						 			<th>Prestado por</th>
						 			<th>Estatus</th>
						 			<th class="text-center"><i class="fa fa-cogs"></i></th>
						 		</tr>
						 	</thead>
						 	<tbody>
						 	<?php foreach ($resultado as $fila) {
						 		if ($fila != NULL) {
						 	?>
						 		<tr>
						 			<td><?php echo $fila['nombre_usuario']; ?></td>
						 			<td><?php echo $fila['nombre_libro']; ?></td>
						 			<td><?php echo $fila['inicio']; ?></td>
						 			<td><?php echo $fila['final']; ?></td>
						 			<td><?php echo $fila['nombre_adm']; ?></td>
						 			<td><?php echo $fila['estatus']; ?></td>
							 		<td class="text-center">
						 				<?php if($fila['estatus'] != 'COMPLETADO'){ ?>
						 					<a class="btn btn-sm btn-primary" href="editar_prestamo.php?id=<?php echo $fila['id']; ?>"><i class="fa fa-edit"></i></a>
						 				<?php } ?>
						 				<!-- <a class="btn btn-sm btn-danger" href="eliminar_usuario.php?id=<?php echo $fila['id']; ?>"><i class="fa fa-trash"></i></a> -->

						 				<?php if ($fila['estatus'] == 'COMPLETADO') { ?>
						 					<a id="eliminar_prestamo" data-href="eliminar_prestamo.php?id=<?php echo $fila['id']; ?>" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
						 				<?php }else{ ?>
						 					<a id="completar_prestamo" data-href="completar_prestamo.php?id=<?php echo $fila['id']; ?>" class="btn btn-sm btn-success" ><i class="fa fa-check"></i></a>

						 					<a id="vence_prestamo" data-href="vencer_prestamo.php?id=<?php echo $fila['id']; ?>" class="btn btn-sm btn-info" ><i class="fa fa-calendar"></i></a>
						 				<?php } } ?>
						 			</td>
						 		</tr>
						 		<?php } ?>
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

        $('a[id="eliminar_prestamo"]').on('click', function(){
        	var $href = $( this ).data('href');

			jQuery.confirm({
				theme: 'supervan',
				columnClass: 'medium',
				title: '¡Atención!',
				content: 'El préstamo se eliminará del sistema',
				buttons: {
			        "Eliminar Préstamo": function(){
			        	btnClass: 'btn-success',
			            jQuery.alert({theme: 'supervan', title: false, content:'Eleiminando...'});
			            location.href = $href;
			        },
			        Cancelar: function(){
			        	jQuery.alert({theme: 'supervan', title: false, content: 'No se efectuaran cambios sobre el préstamo'});
			        }
			    }
			});
		});

        $('a[id="vence_prestamo"]').on('click', function(){
        	var $href = $( this ).data('href');

			jQuery.confirm({
				theme: 'supervan',
				columnClass: 'medium',
				title: '¡Atención!',
				content: 'El préstamo se colocará como VENCIDO y será puesto en la lista de préstamos vencidos',
				buttons: {
			        "Vencer Préstamo": function(){
			        	btnClass: 'btn-success',
			            jQuery.alert({theme: 'supervan', title: false, content:'Desactivando la cuenta del lector ....'});
			            location.href = $href;
			        },
			        Cancelar: function(){
			        	jQuery.alert({theme: 'supervan', title: false, content: 'No se efectuaran cambios sobre el préstamo'});
			        }
			    }
			});
		});

		$('a[id="completar_prestamo"]').on('click', function(){
			var $href = $( this ).data('href');

			jQuery.confirm({
				theme: 'supervan',
				columnClass: 'medium',
				title: '¡Atención!',
				content: 'El préstamo se colocará como COMPLETADO',
				buttons: {
			        "Completar Préstamo": function(){
			        	btnClass: 'btn-success',
			            jQuery.alert({theme: 'supervan', title: false, content:'Cambiando el estado del préstamo ....'});
			            location.href = $href;
			        },
			        Cancelar: function(){
			        	jQuery.alert({theme: 'supervan', title: false, content: 'No se efectuaran cambios sobre el préstamo'});
			        }
			    }
			});
		});
	});
</script>