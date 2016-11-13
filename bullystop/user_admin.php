<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
	<title>Bully Stop</title>
	<meta charset="utf-8">
</head>
<body>
<?php
	session_start();
	
	include("conectarse bd.php");
	$link=conectarse();

	$user = $_SESSION["user"];
	$clave = $_SESSION["clave"];

	$sentenciaSQL = "select count(*) from administradores where id= '$user' AND clave = '$clave'";
	$result = mysql_query($sentenciaSQL,$link);
	$row = mysql_fetch_array($result);
	$is = $row["count(*)"];

	if($is!=1){
		mysql_free_result($result);
		mysql_close($link);
		header("Location: login.html");
	}

	$sentenciaSQL = "select * from administradores where id= '".$_SESSION['user']."'";
	$result = mysql_query($sentenciaSQL,$link);
	$row = mysql_fetch_array($result);

	$nombreAdmin = $row["nombre"];
	$apellidoAdmin = $row["apellido"];
	$claveAdmin = $row["clave"];

	$sentenciaSQL = "select * from instituciones where codigo= ".$_SESSION['institucion_codigo'];
	$result = mysql_query($sentenciaSQL,$link);
	$row = mysql_fetch_array($result);
	
	$nombreInstitucion = $row["nombre"];
	$telefonoInstitucion = $row["telefono"];
	$correoInstitucion = $row["correo"];

	mysql_free_result($result);
	mysql_close($link);

?>

<div data-role="page">
	<div data-role="header">
	<h1>Bully Stop</h1>
	<div data-role="navbar" data-grid="a" data-iconpos="left">
		<ul>
			<li><a href="historial_admin.php" data-icon="comment">Notificaciones</a></li>
			<li><a  data-icon="user" class="ui-btn-active"><?php echo $_SESSION['user']; ?></a></li>
		</ul>
	</div>
	</div>
	<div data-role="content">
		<div class="ui-corner-all custom-corners">	
			<div class="ui-bar ui-bar-a">
				<h3>Información personal</h3>
			</div>
			<div class="ui-body ui-body-a">
					<form action="guardar_edicion_admin.php" method="post" data-ajax="false">
						<div class="ui-field-contain" >		
							<legend>Nombre:</legend>
							<input type="text" name="nombreAdmin" id="nombreAdmin" value="<?php echo $nombreAdmin ?>" data-clear-btn="true">
							<legend>Apellido:</legend>
							<input type="text" name="apellidoAdmin" id="apellidoAdmin" value="<?php echo $apellidoAdmin ?>" data-clear-btn="true">
							<legend>ID de usuario:</legend>
							<input type="text" name="idAdmin" id="idAdmin" value="<?php echo $_SESSION['user']; ?>" data-clear-btn="true" required="">
							<legend>Clave:</legend>
							<input type="password" name="claveAdmin" id="claveAdmin" value="<?php echo $claveAdmin; ?>" data-clear-btn="true" required="">
							<input type="submit" name="guardarEdicion" value="Guardar edición" data-icon="check" data-iconpos="right" data-inline="true">
						</div>	
					</form>	
			</div>
		</div>
		<br>
		<div class="ui-corner-all custom-corners">
			<div class="ui-bar ui-bar-a">
				<h3>Información de la institución</h3>
			</div>
			<div class="ui-body ui-body-a">
				<h4>Nombre: <?php echo $nombreInstitucion ?></h4>
				<h4>Telefono: <?php echo $telefonoInstitucion ?></h4>
				<h4>Correo: <?php echo $correoInstitucion ?></h4>
			</div>	
		</div>
	</div>
	<div data-role="footer" class="ui-bar" data-position="fixed" data-iconpos="left">
	<div data-role="controlgroup" data-type="horizontal">	
		<a href="salir.php" data-icon="power">Salir</a>
		<a data-icon="info">Acerca de</a>
	</div>	
	</div>
</div>
</body>
</html>