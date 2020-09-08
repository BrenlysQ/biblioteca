<?php
	include('./conexion.php');
	header("Content-type: text/html; charset=utf8");
	$conexion = conexion();
	date_default_timezone_set('America/Caracas');
	
	$id = $_POST['id'];
	$inicio = $_POST['inicio'];
	$final = $_POST['final'];


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
							window.location='./editar_prestamo.php?id=$id';
					</script>";
	}else
	{
		if (($mes_fina-$mes_ini) < 0) 
		{
			$_SESSION['mensaje'] = "Ingrese un mes correcto.";
				echo "<script type='text/javascript'>
							//alert('Préstamo registrado con éxito.');
							window.location='./editar_prestamo.php?id=$id';
					</script>";
		}else
		{
			if (($dia_fina-$dia_ini) < 0) 
			{
				$_SESSION['mensaje'] = "Ingrese un día correcto.";
				echo "<script type='text/javascript'>
							//alert('Préstamo registrado con éxito.');
							window.location='./editar_prestamo.php?id=$id';
					</script>";
			}else
			{
				$sql = "UPDATE prestamo SET inicio='$inicio',final='$final' WHERE id='$id'";
				$resultado = mysqli_query($conexion,$sql) or die(mysqli_error());

				$_SESSION['mensaje'] = "Modificación exitosa..";
				echo "<script type='text/javascript'>
							//alert('Préstamo registrado con éxito.');
							window.location='./listar_prestamos.php';
					</script>";
			}

		}
	}

		
?>
