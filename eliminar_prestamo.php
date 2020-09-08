<?php
	include('./conexion.php');
	header("Content-type: text/html; charset=utf8");
	$conexion = conexion();

	$id_prestamo = $_GET['id'];

	$sql = "DELETE from prestamo WHERE id='$id_prestamo'";
	$resultado = mysqli_query($conexion,$sql) or die(mysqli_error()); 

	$_SESSION['mensaje'] = "Préstamo eliminado exitosamente";
	echo "<script type='text/javascript'>
				// alert('Préstamo eliminado exitosamente.');
				window.location='./listar_prestamos.php';
		</script>";
		
?>