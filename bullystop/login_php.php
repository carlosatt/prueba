<?php

include("conectarse bd.php");

if (empty($_POST["modoLogin"])) {
	header("Location: login.html");
}else{

	$tipoUser = $_POST["modoLogin"];

	if ($tipoUser=="admin") {
		
		$user = $_POST["user"];
		$clave = $_POST["clave"];

		$link=conectarse();
		$sentenciaSQL = "select count(*) from administradores where id= '$user' AND clave = '$clave'";
		$result = mysql_query($sentenciaSQL,$link);
		$row = mysql_fetch_array($result);
		$is = $row["count(*)"];

		if($is==1){

			$sentenciaSQL = "select institucion_codigo from administradores where id= '$user' AND clave = '$clave'";		
			$result = mysql_query($sentenciaSQL,$link);
			$row = mysql_fetch_array($result);
			$codigo = $row["institucion_codigo"];

			mysql_free_result($result);
			mysql_close($link);

			session_start();
			$_SESSION["user"]=$user;
			$_SESSION["clave"]=$clave;
			$_SESSION["institucion_codigo"] = $codigo;

			echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=historial_admin.php\">";

		}else{
			mysql_free_result($result);
			mysql_close($link);
			
			echo "<script> alert('Usuario o clave incorrecto'); window.history.back(); </script>";
		}

	}else if ($tipoUser=="student") {

		$user = $_POST["user"];
		$clave = $_POST["clave"];

		$link=conectarse();
		$sentenciaSQL = "select count(*) from usuarios where id= '$user' AND clave = '$clave'";
		$result = mysql_query($sentenciaSQL,$link);
		$row = mysql_fetch_array($result);
		$is = $row["count(*)"];
		
		if($is==1){

			$sentenciaSQL = "select institucion_codigo from usuarios where id= '$user' AND clave = '$clave'";
			$result = mysql_query($sentenciaSQL,$link);
			$row = mysql_fetch_array($result);
			$codigo = $row["institucion_codigo"];

			mysql_free_result($result);
			mysql_close($link);

			session_start();
			$_SESSION["user"]=$user;
			$_SESSION["institucion_codigo"] = $codigo;

			echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=principal.php\">";
		}else{
			mysql_free_result($result);
			mysql_close($link);
			
			echo "<script> alert('Usuario o clave incorrecto'); window.history.back(); </script>";
		}

	}else{
		echo "<script> alert('Elegir como desea entrar'); window.history.back(); </script>";
	}
}

?>