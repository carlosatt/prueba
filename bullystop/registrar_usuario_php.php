<?php
include("conectarse bd.php");
$link=conectarse();

if (empty($_POST["modoLoginRegister"])) {
	header("Location: registrar_usuario.php");
}else{
	$salto = '\n';
	$tipoUser = $_POST["modoLoginRegister"];

	if ($tipoUser=="admin" && !empty($_POST["idAdmin"]) && !empty($_POST["claveAdmin"])) {
		$institucionAdmin = $_POST["institucionesAdmin"];
		$nombre = $_POST["nombre"];
		$apellido = $_POST["apellido"];
		$pin = $_POST["pin"];
		$idAdmin = $_POST["idAdmin"];
		$claveAdmin = $_POST["claveAdmin"];	

		$sentenciaSQL = "select codigo from instituciones where nombre = '$institucionAdmin'";
		$result = mysql_query($sentenciaSQL,$link);
		$row = mysql_fetch_array($result);
		$codigo = $row["codigo"];

		if ($pin==$codigo) {
			$sentenciaSQL = "insert into administradores VALUES('".$idAdmin."','".$claveAdmin."','".$nombre."','".$apellido."',".$codigo.")";

			$result = mysql_query($sentenciaSQL,$link);

			if($result==1){
				mysql_close($link);
				echo "<script> alert('Registro de usuario exitoso'); window.location='login.html'; </script>";
			}else{
				mysql_close($link);
				echo "<script> alert('Registro de usuario incorrecto $salto $salto * Intente con otro ID $salto * Seleccione una institucion $salto * Registre todos los campos $salto * Verifique el PIN'); window.history.back(); </script>";
			}
		}else{
			mysql_free_result($result);
			mysql_close($link);
			echo "<script> alert('PIN incorrecto'); window.history.back(); </script>";
		}

	}else if ($tipoUser=="student"  && !empty($_POST["idStudent"]) && !empty($_POST["claveStudent"])) {
		$institucionUser = $_POST["institucionesUser"];
		$idStudent = $_POST["idStudent"];
		$claveStudent = $_POST["claveStudent"];

		$sentenciaSQL = "select codigo from instituciones where nombre = '$institucionUser'";
		$result = mysql_query($sentenciaSQL,$link);
		$row = mysql_fetch_array($result);
		$codigo = $row["codigo"];

		$sentenciaSQL = "insert into usuarios VALUES('".$idStudent."','".$claveStudent."','','',".$codigo.")";

		$result = mysql_query($sentenciaSQL,$link);

		if($result==1){
			mysql_close($link);
			echo "<script> alert('Registro de usuario exitoso'); window.location='login.html'; </script>";
		}else{
			mysql_close($link);
			echo "<script> alert('Registro de usuario incorrecto $salto $salto * Intente con otro ID $salto * Seleccione una institucion $salto * Registre todos los campos'); window.history.back(); </script>";
		}
	}else{
		echo "<script> alert(' * Elegir el tipo de usuario a registrar $salto * Registrar ID de usuario y clave'); window.history.back(); </script>";
	}
}
?>