<?php
	include('./conexion.php');
	header("Content-type: text/html; charset=utf8");
	$conexion = conexion();

	$id_usuario = $_GET['id']; 
	$estatu = "DESACTIVADO";

	$sql = "UPDATE usuario SET estatus='$estatu' WHERE id='$id_usuario'";
	$resultado = mysqli_query($conexion,$sql) or die(mysqli_error()); 

	$_SESSION['mensaje'] = 'Usuario desactivado exitosamente';
	echo "<script type='text/javascript'>
				// alert('');
				window.location='../index_usuarios.php';
		</script>";
		
?>
