<?php
	include_once("./conexion.php");
	$conexion = conexion();

	$buscadora = $_GET['term'];
	$dql="SELECT * FROM `libro` where `titulo` like '%$buscadora%' or autor like '%$buscadora%' LIMIT 0 , 10";
		
	$resultado = mysqli_query($conexion,$dql) or die(mysql_error());            
	$return_arr = array();
	
	if(mysqli_num_rows($resultado)>0){
		while($elemento = mysqli_fetch_array($resultado)){
			$nombre = $elemento[1];
			$return_arr[] =  utf8_encode($elemento[0]."->".$nombre);
		}			
	}else{
		$return_arr[] =  utf8_encode("Sin resultados");
		
	}
	echo json_encode($return_arr);
?>