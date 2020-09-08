<?php

	session_start();
	include('conexion.php');
	$conexion = conexion();

	header("Content-type: text/html; charset=utf8");
	
	$titulo = $_POST['titulo'];
	$isbm = $_POST['isbm'];
    $autor = $_POST['autor'];
    $id_adm = $_POST['id_adm'];
    $prestado = 0;

	
	$sql = "INSERT INTO libro VALUES (null,'$titulo','$isbm','$autor','$prestado','$id_adm')";

	$resultado = mysqli_query($conexion,$sql) or die(mysqli_error());

	echo "<script type='text/javascript'>
				alert('Libro agregado con éxito.');
				window.location='./listar_libros.php';
		</script>";
	mysqli_close($conexion);
?>
