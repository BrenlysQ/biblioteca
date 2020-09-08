<?php
	session_start();
	include('conexion.php');
	$conexion = conexion();

	header("Content-type: text/html; charset=utf8");
	$usuario = $_SESSION['dato_usuario'];
	
	if (!isset($_POST['nombre'])) {
		$_SESSION['mensaje'] = "No se ha recibido nombre en el POST";
		echo "<script type='text/javascript'>
				alert('No se ha recibido nombre en el POST ');
				window.location='./agregar_usuario.php';
		</script>";
	}
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
    $cedula = $_POST['cedula'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $carrera =$_POST['carrera'];
    $id_adm = $_POST['id_adm'];
    $estatus = "ACTIVO";
    $prestamos = 0;

	$sql = "SELECT * FROM usuario WHERE cedula = '$cedula'";
	$resultado = mysqli_query($conexion,$sql) or die(mysqli_error()); 

	if (mysqli_num_rows($resultado) > 0) 
	{
		echo "<script type='text/javascript'>
				alert('Cédula ya existente.');
				window.location='./agregar_usuario.php';
		</script>";
	}else
		{
			$sql = "SELECT * FROM usuario WHERE correo = '$correo'";
			$resultado = mysqli_query($conexion,$sql) or die(mysqli_error()); 

			if (mysqli_num_rows($resultado) > 0) 
			{
				echo "<script type='text/javascript'>
						alert('Correo ya existente.');
						window.location='./agregar_usuario.php';
				</script>";
			}else
			{
				$sql = "INSERT INTO usuario VALUES (null,'$nombre','$apellido','$cedula','$telefono','$correo','$carrera',NOW(),'$estatus','$prestamos','$id_adm')";
				$resultado = mysqli_query($conexion,$sql) or die(mysqli_error());

				$_SESSION['mensaje'] = 'Se ha agregado a "'.$nombre.' '.$apellido.'" con éxito';
				echo "<script type='text/javascript'>
							// alert('Usuario agregado con éxito.');
							window.location='./index_usuarios.php';
					</script>";
				mysqli_close($conexion);

			}
		}
	
?>
