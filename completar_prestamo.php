<?php
	include('./conexion.php');
	header("Content-type: text/html; charset=utf8");
	$conexion = conexion();

	$id = $_GET['id']; 
	$estatu = "COMPLETADO";

	$sql = "SELECT * FROM prestamo WHERE id = '$id'";
	$resultado = mysqli_query($conexion,$sql) or die(mysqli_error());
	$row = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
	$id_libro = $row['id_libro'];

	$sql = "SELECT * FROM libro WHERE id = '$id_libro'";
	$resultado = mysqli_query($conexion,$sql) or die(mysqli_error());
	$row = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
	$cantidad = $row['isbm']+1;

	$sql = "UPDATE libro SET isbm='$cantidad' WHERE id='$id_libro'";
	$resultado = mysqli_query($conexion,$sql) or die(mysqli_error());

	$sql = "UPDATE prestamo SET estatus='$estatu' WHERE id='$id'";
	$resultado = mysqli_query($conexion,$sql) or die(mysqli_error()); 

	$_SESSION['mensaje'] = 'Préstamo completado exitosamente.';
	echo "<script type='text/javascript'>
				// alert('');
				window.location='./listar_prestamos.php';
		</script>";
		
?>