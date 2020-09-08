<?php
	session_start();
    unset ($_SESSION["dato_usuario"]);
    session_unset();
    session_destroy();
    header('Location: index.html');
?>