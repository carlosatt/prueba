<?php

if (empty($_POST["idUser"]) || empty($_POST["claveUser"])) {
	$salto = '\n';
	echo "<script>alert('Error en la actualizacion de datos $salto $salto * Ingrese al menos ID de usuario y clave'); window.history.back(); </script>";
}else{

	include("conectarse bd.php");
	$link=conectarse();

	session_start();

	$sentenciaSQL = "update usuarios 
						set id= '".$_POST["idUser"].
						"', clave= '".$_POST["claveUser"].
						"', telefono= '".$_POST["telefonoUser"].
						"', correo= '".$_POST["email"].
						"' where id= '".$_SESSION["user"]."'";

	$result = mysql_query($sentenciaSQL,$link);

	if ($result==1) {
		mysql_close($link);
		$_SESSION["user"]=$_POST["idUser"];
		echo "<script>alert('Datos actualizado correctamente'); window.location='user.php';</script>";
	}else{
		mysql_close($link);
		echo "<script>alert('Error en la actualizacion de datos'); window.history.back(); </script>";
	}
}
?>