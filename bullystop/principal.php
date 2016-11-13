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
?>
<div data-role="page">
	<div data-role="header">
	<h1>Bully Stop</h1>
	<div data-role="navbar" data-grid="b" data-iconpos="left">
		<ul>
			<li><a  data-icon="home" class="ui-btn-active">Notificar</a></li>
			<li><a href="historial.php"  data-icon="clock" >Historial</a></li>
			<li><a href="user.php" data-icon="user" ><?php echo $_SESSION['user']; ?></a></li>
		</ul>
	</div>
	</div>
	<div data-role="content">
		<div class="ui-corner-all custom-corners">	
			<div class="ui-bar ui-bar-a">
				<h3>Información de la situación de Bullying</h3>
			</div>
			<div class="ui-body ui-body-a">
				<form action="registrar_notificacion.php" method="POST" data-ajax="false">
					<div class="ui-field-contain" >
						<input type="text" name="nombreVictima" id="nombreVictima" placeholder="Nombre de la victima" data-clear-btn="true" required="">
						<input type="text" name="cursoVictima" id="cursoVictima" placeholder="Curso de la victima" data-clear-btn="true">
						<input type="text" name="victimarios" id="victimarios" placeholder="Nombres de los victimarios" data-clear-btn="true" required="">
						<textarea name="informe" id="informe" placeholder="Escribir detalladamente la situacion de Bullying" data-clear-btn="true"></textarea>
						<input type="submit" name="enviar" value="Enviar" data-icon="navigation" data-iconpos="top" data-inline="true" >
					</div>	
				</form>	
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