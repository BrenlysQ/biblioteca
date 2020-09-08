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
?>
<html lang="es">
<head>
	<title>Libros Registrados</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="./assets/bootstrap337/css/bootstrap.css" />
	<link rel="stylesheet" href="./assets/css/main.css" />
</head>

<body>
	<?php include('./menu_usuario_global.php'); ?>
	<div id="main">
		<section id="top" class="one facyt">
		<!-- <section id="top" class="two"> -->
			<div class="container">
				<header>
					<h2>Listado de Libros Registrados</h2>
				</header>
			</div>
		</section>
		<section id="top" class="menu">
			<a href="./agregar_libro.php" class="boton_sub_menu">Agregar Libro</a>
		</section>
	
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<!-- PARA OBTENER LAS ENTRADAS DE LA BASE DE DATOS -->
					<?php
						$sql = "SELECT libro.* , admin.nombre as nombre_adm  from libro , admin WHERE libro.id_adm=admin.id";
						// $resultado = mysqli_fetch_all(mysqli_query($conexion, $sql), MYSQLI_ASSOC);
						$res = mysqli_query($conexion, $sql);
						while($resultado[] = $res->fetch_assoc());
					 ?>
					 <div class="table-responsive">
						 <table id="dataTable" class="table table-bordered table-stripped">
						 	<thead>
						 		<tr>
						 			<th>Título</th>
						 			<th>Ejemplar</th>
						 			<th>Autor</th>	
						 			<th>Ingresado Por</th>
						 			<th class="text-center"><i class="fa fa-cogs"></i></th>
						 		</tr>
						 	</thead>
						 	<tbody>
						 	<?php foreach ($resultado as $fila) {
						 			if ($fila != NULL) {
						 	 ?>
						 		<tr>
						 			<td><?php echo $fila['titulo']; ?></td>
						 			<td><?php echo $fila['isbm']; ?></td>
						 			<td><?php echo $fila['autor']; ?></td>
						 			<td><?php echo $fila['nombre_adm']; ?></td>
						 			<td class="text-center">
						 				<a class="btn btn-sm btn-primary" href="editar_libro.php?id=<?php echo $fila['id']; ?>"><i  class="fa fa-edit"></i></a> 
						 				<a class="btn btn-sm btn-danger" id="eliminar_libro" data-nombre="<?php echo $fila['titulo']; ?>" data-href="eliminar_libro.php?id=<?php echo $fila['id']; ?>"><i class="fa fa-times"></i></a> 
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
<!-- Inicializando la dataTable -->
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

        $('a[id="eliminar_libro"]').on('click', function(){
			var $href = $( this ).data('href');
			libro_nombre = $( this ).data('nombre')

			jQuery.confirm({
				theme: 'supervan',
				columnClass: 'medium',
				title: '¡Atención!',
				content: '¿Desea eliminar el libro "'+libro_nombre+'"?',
				buttons: {
			        "Eliminar Libro": function(){
			            jQuery.alert({theme: 'supervan', title: false, content:'Eliminando el libro ...'});
			            location.href = $href;
			        },
			        Cancelar: function(){
			        	jQuery.alert({theme: 'supervan', title: false, content: 'No se efectuaran cambios sobre el libro ...'});
			        }
			    }
			});
		});
	});
</script>