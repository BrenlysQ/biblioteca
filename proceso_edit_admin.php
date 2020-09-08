<?php
	session_start();
	include('./conexion.php');
	header("Content-type: text/html; charset=utf8");
	$conexion = conexion();

	$datos_usuario = $_SESSION['datos_usuario'];
	$id = $datos_usuario['id'];

	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$cedula = $_POST['cedula'];
	$usuario = $_POST['usuario'];
	$contrasena = $_POST['contrasena'];

	$sql = "SELECT * FROM admin WHERE id !='$id' and usuario = '$usuario'";
	$resultado = mysqli_query($conexion,$sql) or die(mysqli_error()); 

	if (mysqli_num_rows($resultado) > 0) 
	{
		$_SESSION['mensaje'] = 'Nombre de usuario existente.';
		echo "<script type='text/javascript'>
				// alert('Nombre de usuario existente.');
				window.location='./editar_admin.php';
		</script>";
	}else
		{
			$sql = "SELECT * FROM admin WHERE id !='$id' and cedula = '$cedula'";
			$resultado = mysqli_query($conexion,$sql) or die(mysqli_error()); 

			if (mysqli_num_rows($resultado) > 0) 
			{
				$_SESSION['mensaje'] = 'La cédula que introdujo ya existe.';
				echo "<script type='text/javascript'>
						// alert('La cédula que introdujo ya existe.');
						window.location='./editar_admin.php';
				</script>";
			}else
			{
				$sql = "UPDATE admin SET nombre='$nombre',apellido='$apellido',cedula='$cedula',usuario='$usuario',contrasena='$contrasena' WHERE id='$id'";
				$resultado = mysqli_query($conexion,$sql) or die(mysqli_error()); 

				$_SESSION['mensaje'] = 'Modificación exitosa';
				echo "<script type='text/javascript'>
							// alert('Modificación exitosa.');
							window.location='./listar_administradores.php';
					</script>";
			}
		}	
		
?>