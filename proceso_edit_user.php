<?php
include('./conexion.php');
header("Content-type: text/html; charset=utf8");
$conexion = conexion();

	$id = $_POST['id'];
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
    $cedula = $_POST['cedula'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $carrera =$_POST['carrera'];

    $sql = "SELECT * FROM usuario WHERE id !='$id' and correo = '$correo'";
	$resultado = mysqli_query($conexion,$sql) or die(mysqli_error()); 

	if (mysqli_num_rows($resultado) > 0) 
	{
		// $_SESSION['mensaje'] = '';
		echo "<script type='text/javascript'>
				alert('Correo existente.');
				window.location='./editar_usuario.php?id=$id';
		</script>";
	}else
		{
			$sql = "SELECT * FROM usuario WHERE id !='$id' and cedula = '$cedula'";
			$resultado = mysqli_query($conexion,$sql) or die(mysqli_error()); 

			if (mysqli_num_rows($resultado) > 0) 
			{
				echo "<script type='text/javascript'>
						alert('La cédula que introdujo ya existe.');
						window.location='./editar_usuario.php?id=$id';
					</script>";
			}else
			{
				$sql = "UPDATE usuario SET nombre='$nombre',apellido='$apellido',cedula='$cedula',telefono='$telefono',correo='$correo',carrera='$carrera' WHERE id='$id'";
				$resultado = mysqli_query($conexion,$sql) or die(mysqli_error()); 

				$_SESSION['mensaje'] = 'Se modificó exitosamente los datos de "'.$nombre.' '.$apellido.'"';
				echo "<script type='text/javascript'>
							// alert('Modificación exitosa.');
							window.location='./index_usuarios.php';
					</script>";
			}
		}	
	
?>
