<?php
	session_start();
	include('./conexion.php');
	header("Content-type: text/html; charset=utf8");
	$conexion = conexion();

	$datos_usuario = $_SESSION['datos_usuario'];
	$id = $datos_usuario['id'];
	$estatu = "DESACTIVADO";

	$sql = "UPDATE admin SET estatus='$estatu' WHERE id='$id'";
	$resultado = mysqli_query($conexion,$sql) or die(mysqli_error()); 

	echo "<script type='text/javascript'>
				alert('Usted se retira como administrador, ya no podrá ingresar con esta cuenta.');
				window.location='./cerrar_session.php';
		</script>";
		
?>