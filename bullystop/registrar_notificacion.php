<?php
include("conectarse bd.php");

if (empty($_POST["nombreVictima"])|| empty($_POST["victimarios"])) {
	$salto = '\n';
	echo "<script> alert('Registro incorrecto de notificacion $salto $salto * Ingrese al menos el nombre de la victima y el nombre del victimario(s)'); window.history.back(); </script>";
}else{

	$link=conectarse();

	$nombreVictima = $_POST["nombreVictima"];
	$cursoVictima = $_POST["cursoVictima"];
	$victimarios = $_POST["victimarios"];
	$informe = $_POST["informe"];
	$fecha = date("Y-m-d");

	session_start();

	$sentenciaSQL = "insert into notificaciones VALUES('','$nombreVictima','$victimarios','$cursoVictima','$fecha','$informe','".$_SESSION["user"]."',".$_SESSION["institucion_codigo"].")";
	$result = mysql_query($sentenciaSQL,$link);

	mysql_close($link);

	if($result==1){
		echo "<script> alert('Notificacion registrada exitosamente'); window.location='principal.php'; </script>";
	}else{
		echo "<script> alert('Registro incorrecto de notificacion'); window.history.back(); </script>";
	}
}
?>