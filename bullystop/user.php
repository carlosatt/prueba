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
	if(empty($_SESSION)){
		header("Location: login.html");
	}

	include("conectarse bd.php");
	$link=conectarse();

	$sentenciaSQL = "select * from usuarios where id= '".$_SESSION['user']."'";
	$result = mysql_query($sentenciaSQL,$link);
	$row = mysql_fetch_array($result);

	$telefonoUsuario = $row["telefono"];
	$correoUsuario = $row["correo"];
	$claveUsuario = $row["clave"];

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
	<div data-role="navbar" data-grid="b" data-iconpos="left">
		<ul>
			<li><a href="principal.php" data-icon="home" >Notificar</a></li>
			<li><a href="historial.php"  data-icon="clock" >Historial</a></li>
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
					<form action="guardar_edicion.php" method="post" data-ajax="false">
						<div class="ui-field-contain" >
							<legend>ID de usuario:</legend>
							<input type="text" name="idUser" id="idUser" value="<?php echo $_SESSION['user']; ?>" data-clear-btn="true" required="">
							<legend>Clave:</legend>
							<input type="password" name="claveUser" id="claveUser" value="<?php echo $claveUsuario; ?>" data-clear-btn="true" required="">
							<legend>Telefono:</legend>
							<input type="number" name="telefonoUser" id="telefonoUser" value="<?php echo $telefonoUsuario ?>" data-clear-btn="true">
							<legend>Correo:</legend>
							<input type="email" name="email" id="email" value="<?php echo $correoUsuario ?>" data-clear-btn="true">
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