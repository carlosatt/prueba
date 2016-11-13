<?php

if (empty($_POST["idAdmin"]) || empty($_POST["claveAdmin"])) {
	$salto = '\n';
	echo "<script>alert('Error en la actualizacion de datos $salto $salto * Ingrese al menos ID de usuario y clave'); window.history.back(); </script>";
}else{

	include("conectarse bd.php");
	$link=conectarse();

	session_start();

	$sentenciaSQL = "update administradores 
						set id= '".$_POST["idAdmin"].
						"', clave= '".$_POST["claveAdmin"].
						"', nombre= '".$_POST["nombreAdmin"].
						"', apellido= '".$_POST["apellidoAdmin"].
						"' where id= '".$_SESSION["user"]."'";

	$result = mysql_query($sentenciaSQL,$link);

	if ($result==1) {
		mysql_close($link);

		$_SESSION["user"]=$_POST["idAdmin"];
		$_SESSION["clave"]=$_POST["claveAdmin"];
		
		echo "<script> alert('Datos actualizado correctamente'); window.location='user_admin.php'; </script>";
	}else{
		mysql_close($link);

		echo "<script> alert('Error en la actualizacion de datos'); window.history.back(); </script>";
	}
}
?>