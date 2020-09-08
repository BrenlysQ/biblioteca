<?php
	if(!isset($_SESSION)) {
		session_start();
	}
	date_default_timezone_set('America/Caracas');
    function conexion(){
        $conexion = mysqli_connect('localhost','root','root','facyt'); //Para la computadora de Manuel @ EA
        // $conexion = mysqli_connect('localhost','root','root','facyt');
        mysqli_set_charset($conexion, "utf8");
        return $conexion;
    }
?>