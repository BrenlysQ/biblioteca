<?php
	include('./conexion.php');
	header("Content-type: text/html; charset=utf8");
	$conexion = conexion();

	$id = $_GET['id']; 
	$estatu = "VENCIDO";

	$sql = "UPDATE prestamo SET estatus='$estatu' WHERE id='$id'";
	$resultado = mysqli_query($conexion,$sql) or die(mysqli_error()); 

	$_SESSION['mensaje'] = 'Cambio de estatus exitoso.';
	echo "<script type='text/javascript'>
				// alert('');
				window.location='./listar_prestamos.php';
		</script>";
		
?>