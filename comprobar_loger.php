<?php
	include('conexion.php');
	$conexion = conexion();
	
	header("Content-type: text/html; charset=utf8");

	$usuario = $_POST['usuario'];
	$contraseña = $_POST['Password'];
	$estatus = "ACTIVO";

	/**************************************************************/
	/**************************************************************
	CORREGIR TODA LA LOGICA DE ESTA PARTE DEL CODIGO
	
	SI EXISTE EL USUARIO
		SI EXISTE, LUEGO VERIFICA QUE LA CONTRASEÑA SEA LA CORRECTA
			SI LA CONTRASEÑA ES LA CORRECTA VERIFICA EL ESTADO DE LA CUENTA
			NO TIENE CUENTA ACTIVA, SE VA A LA VISTA DE INDEX.HTML
		NO ES LA CONTRASEÑA, SE VA A LA VISTA DE INDEX.HTML
	NO EXISTE EL USUARIO, SE VA A LA VISTA DE INDEX.HTML
	
	**************************************************************/
	/**************************************************************/

		$sql = "SELECT * FROM admin WHERE usuario ='$usuario'";
		$resultado = mysqli_query($conexion, $sql) or die(mysqli_error());  

		if (mysqli_num_rows($resultado) == 1 ) 
		{
			$sql = "SELECT * FROM admin WHERE usuario ='$usuario' and contrasena ='$contraseña'";
			$resultado = mysqli_query($conexion, $sql) or die(mysqli_error()); 

			if (mysqli_num_rows($resultado) == 1 ) 
			{
				$sql = "SELECT * FROM admin WHERE usuario ='$usuario' and contrasena ='$contraseña' and estatus = '$estatus'";
				$resultado = mysqli_query($conexion, $sql) or die(mysqli_error());

				if( mysqli_num_rows($resultado) == 1)
				{	
					// print_r(mysqli_fetch_assoc($resultado)); die();
					$_SESSION['dato_usuario'] = $usuario;
					$_SESSION['datos_usuario'] = mysqli_fetch_assoc($resultado);
					header("Location: listar_administradores.php");
				}else
				{
					echo "<script type='text/javascript'>
								 alert('Usted se encuentra bloqueado.');
								window.location='./index_usuarios.php';
						</script>";
				}
			}else
			{
				echo "<script type='text/javascript'>
								 alert('Datos incorrectos.');
								window.location='./index_usuarios.php';
						</script>";;
			}
		}else
		{
			echo "<script type='text/javascript'>
								 alert('Datos incorrectos.');
								window.location='./index_usuarios.php';
						</script>";
		}	
	
	
	mysqli_close($conexion);
?>
