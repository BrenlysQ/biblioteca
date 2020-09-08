<?php

	session_start();
	include('conexion.php');
	$conexion = conexion();

	header("Content-type: text/html; charset=utf8");

	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$cedula = $_POST['cedula'];
	$usuario = $_POST['usuario'];
	$contrasena = $_POST['contrasena'];
	$contrasena_rep = $_POST['contrasena_rep'];
	$estatus = "ACTIVO";

	if (is_numeric($cedula))
	{
		$sql = "SELECT * FROM admin WHERE usuario = '$usuario'";
		$resultado = mysqli_query($conexion,$sql) or die(mysqli_error()); 

		if (mysqli_num_rows($resultado) > 0) 
		{
			$_SESSION['mensaje'] = 'Nombre de usuario existente';
			echo "<script type='text/javascript'>
					// alert('Nombre de usuario existente.');
					window.location='./agregar_admin.php';
			</script>";
		}else
			{
				$sql = "SELECT * FROM admin WHERE cedula = '$cedula'";
				$resultado = mysqli_query($conexion,$sql) or die(mysqli_error()); 

				if (mysqli_num_rows($resultado) > 0) 
				{
					$_SESSION['mensaje'] = 'La cédula que introdujo ya existe.';
					echo "<script type='text/javascript'>
							// alert('La cédula que introdujo ya existe.');
							window.location='./agregar_admin.php';
					</script>";
				}else
				{
					if ($contrasena != $contrasena_rep) 
					{
						$_SESSION['mensaje'] = 'Las contraseñas son distintas.';
					echo "<script type='text/javascript'>
							// alert('Las contraseñas son distintas.');
							window.location='./agregar_admin.php';
					</script>";
					}else
					{
						$sql = "INSERT INTO admin VALUES (null,'$nombre','$apellido','$cedula','$usuario','$contrasena','$estatus')";
						$resultado = mysqli_query($conexion,$sql) or die(mysqli_error());

						$_SESSION['mensaje'] = 'Administrador registrado con éxito.';
						echo "<script type='text/javascript'>
									// alert('Administrador registrado con éxito.');
									window.location='./listar_administradores.php';
							</script>";
						mysqli_close($conexion);
					}	
				}
			}
	}else
	{
		$_SESSION['mensaje'] = 'Ingrese sólo números en el campo cédula.';
					echo "<script type='text/javascript'>
							// alert('Las contraseñas son distintas.');
							window.location='./agregar_admin.php';
					</script>";
	}
	
	
	?>
