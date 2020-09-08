<?php
include('./conexion.php');
header("Content-type: text/html; charset=utf8");
$conexion = conexion();

	$id = $_POST['id'];
	$titulo = $_POST['titulo'];
	$isbm = $_POST['isbm'];
    $autor = $_POST['autor'];

	$sql = "UPDATE libro SET titulo='$titulo',isbm='$isbm',autor='$autor' WHERE id='$id'";
	$resultado = mysqli_query($conexion,$sql) or die(mysqli_error()); 

	$_SESSION['mensaje'] = "Modificación exitosa de '".$titulo."'";
	echo "<script type='text/javascript'>
				window.location='./listar_libros.php';
		</script>";
?>
