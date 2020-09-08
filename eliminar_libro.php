<?php
	include('./conexion.php');
	header("Content-type: text/html; charset=utf8");
	$conexion = conexion();

	$id_libro = $_GET['id']; 

	$sql = "DELETE from libro WHERE id='$id_libro'";
	$resultado = mysqli_query($conexion,$sql) or die(mysqli_error()); 

	echo "<script type='text/javascript'>
				alert('Libro eliminado exitosamente.');
				window.location='./listar_libros.php';
		</script>";
		
?>
