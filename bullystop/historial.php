<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
	<title>Bully Stop</title>	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
<?php
	session_start();
	if(empty($_SESSION)){
		header("Location: login.html");
	}
?>
<div data-role="page" id="historial" >
	<div data-role="header">
	<h1>Bully Stop</h1>
	<div data-role="navbar" data-grid="b" data-iconpos="left">
		<ul>
			<li><a href="principal.php" data-icon="home" >Notificar</a></li>
			<li><a href="#" data-icon="clock" class="ui-btn-active">Historial</a></li>
			<li><a href="user.php" data-icon="user" ><?php echo $_SESSION['user']; ?></a></li>
		</ul>
	</div>
	</div>
	<div data-role="content">
		<?php 
			include("conectarse bd.php");
			$link=conectarse();

			$sentenciaSQL = "select * from notificaciones where usuario_id= '".$_SESSION['user']."'";
			$result = mysql_query($sentenciaSQL,$link);
		?>
		<table data-role="table" id="tableHistorial" data-mode="columntoggle" class="ui-body-d ui-shadow table-stripe ui-responsive" data-column-btn-theme="b" data-column-btn-text="Mostrar Columnas..." data-column-popup-theme="a">
			<thead>
				<tr class="ui-bar-d">
					<th data-priority="1">Fecha</th>
					<th >Nombre de la victima</th>
					<th data-priority="3">Curso de la victima</th>
					<th data-priority="2">Victimarios</th>
					<th>Descripción</th>
				</tr>
			</thead>
			<tbody>
				<?php  
					while ($row = mysql_fetch_array($result)) {
						printf("
							<tr>
								<th>%s</th>
								<td>%s</td>
								<td>%s</td>
								<td>%s</td>
								<td>%s</td>
							</tr>	
						",$row["fecha"],$row["nombre_victima"],$row["curso_victima"],$row["nombre_victimario"],$row["descripcion"]);
					}
					mysql_free_result($result);
					mysql_close($link);
				?>
			</tbody>
		</table>
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