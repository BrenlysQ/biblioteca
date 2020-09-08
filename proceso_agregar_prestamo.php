<?php
	include('conexion.php');
	$conexion = conexion();
	
	$libro = $_POST['libro'];
	$idnuevo = explode("->",$libro);
	$id_libro = $idnuevo[0];

	$usuario = $_POST['usuario'];
	$id_nuevo = explode("->",$usuario);
	$id_estudiante = $id_nuevo[0];
	$estatus = "PENDIENTE";
	

	$inicio = $_POST['inicio'];
	$final = $_POST['final'];
	$id_adm = $_POST['id_adm'];

	$fecha_inicio = new DateTime($inicio);
	$fecha_final = new DateTime($final);

	$dia_ini = $fecha_inicio->format('d');
	$dia_fina = $fecha_final->format('d');

	$año_ini = $fecha_inicio->format('y');
	$año_fina = $fecha_final->format('y');

	$mes_ini = $fecha_inicio->format('m');
	$mes_fina = $fecha_final->format('m');

	


	if (($año_fina-$año_ini) < 0) 
	{
		$_SESSION['mensaje'] = "Ingrese un año correcto.";
				echo "<script type='text/javascript'>
							//alert('Préstamo registrado con éxito.');
							window.location='./agregar_prestamo.php';
					</script>";
	}else
	{
		if (($mes_fina-$mes_ini) < 0) 
		{
			$_SESSION['mensaje'] = "Ingrese un mes correcto.";
				echo "<script type='text/javascript'>
							//alert('Préstamo registrado con éxito.');
							window.location='./agregar_prestamo.php';
					</script>";
		}else
		{
			if (($dia_fina-$dia_ini) < 0) 
			{
				$_SESSION['mensaje'] = "Ingrese un día correcto.";
				echo "<script type='text/javascript'>
							//alert('Préstamo registrado con éxito.');
							window.location='./agregar_prestamo.php';
					</script>";
			}else
			{
					$sql = "SELECT * FROM libro WHERE id = '$id_libro'";
					$resultado = mysqli_query($conexion,$sql) or die(mysqli_error());
					$row = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
					$cantidad = $row['isbm'];

				if ($cantidad > 0) 
				{
					$cantidad = $cantidad - 1;
					$prestado = $row['prestado'] + 1;
					$sql = "UPDATE libro SET prestado ='$prestado' , isbm ='$cantidad'  WHERE id='$id_libro'";
					$resultado = mysqli_query($conexion,$sql) or die(mysqli_error());

					$sql = "SELECT * FROM usuario WHERE id = '$id_estudiante'";
					$resultado = mysqli_query($conexion,$sql) or die(mysqli_error());
					$row = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
					$prestamos = $row['prestamos'] + 1;

					$sql = "UPDATE usuario SET prestamos ='$prestamos'  WHERE id='$id_estudiante'";
					$resultado = mysqli_query($conexion,$sql) or die(mysqli_error());

					$sql = "INSERT INTO prestamo VALUES (null,'$inicio','$final','$id_libro','$id_estudiante','$id_adm','$estatus')";
					$resultado = mysqli_query($conexion,$sql) or die(mysqli_error());

					$_SESSION['mensaje'] = "Préstamo registrado con éxito.";
					echo "<script type='text/javascript'>
								//alert('Préstamo registrado con éxito.');
								window.location='./listar_prestamos.php';
						</script>";
				}else
				{
					$_SESSION['mensaje'] = "Libro no disponible.";
					echo "<script type='text/javascript'>
								//alert('Préstamo registrado con éxito.');
								window.location='./agregar_prestamo.php';
						</script>";
				}
				
			}

		}
	}

	mysqli_close($conexion);
?>
