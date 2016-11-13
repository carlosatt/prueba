<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
	<title>Bully Stop</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	
	<script type="text/javascript">
		function expandStudentCollapsible(formulario){
			if (formulario.modoLoginRegister.selectedIndex == 1) {
				$("#collapsibleSetRegisterUser").children("#studentCollapsible").collapsible("expand");
			}else if (formulario.modoLoginRegister.selectedIndex==2) {
				$("#collapsibleSetRegisterUser").children("#adminCollapsible").collapsible("expand");
			}
			
		}
	</script>
</head>
<body>
<div data-role="page">
	<div data-role="header">
	<h1>Bully Stop</h1>	
	</div>
	<div data-role="content" >
		<h3 align="center">Registro de usuario</h3>
		<form action="registrar_usuario_php.php" method="post" data-ajax="false">
			<div class="ui-field-contain">
				<select name="modoLoginRegister" id="modoLoginRegister" data-icon="user" data-iconpos="left" data-native-menu="false" onchange="expandStudentCollapsible(this.form)">
					<option value="selectUserRegister" data-placeholder="true" >Elegir el tipo de usuario a registrar</option>
					<option value="student">Estudiante</option>
					<option value="admin">Administrador</option>
				</select>

				<?php
					include("conectarse bd.php");
					$link=conectarse();

					$sentenciaSQL = "select * from instituciones";
					$result = mysql_query($sentenciaSQL,$link);
				?>
				
				<div data-role="collapsibleset" id="collapsibleSetRegisterUser">
					<div data-role="collapsible" id="studentCollapsible">
						<h1>Registro de estudiante</h1>
						
						<select name="institucionesUser" id="institucionesUser" data-native-menu="false" data-icon="location" data-iconpos="left">
						
						<option value="selectInstitucionStudent" data-placeholder="true">Elegir institución</option>
						
						<?php
							while ($row = mysql_fetch_array($result)) {
								printf("
									<option value='%s'>%s</option>	
								",$row["nombre"],$row["nombre"]);
							}
						?>
						
						</select>
						
						<input type="text" name="idStudent" id="idStudent" placeholder="ID de usuario" data-clear-btn="true">
						<input type="password" name="claveStudent" id="claveStudent" placeholder="Clave" data-clear-btn="true">
					</div>

					<div data-role="collapsible" id="adminCollapsible">
						<h1>Registro de administrador</h1>
						
						<select name="institucionesAdmin" id="institucionesAdmin" data-native-menu="false" data-icon="location" data-iconpos="left">
						
						<option value="selectInstitucionAdmin" data-placeholder="true">Elegir institución</option>
						
						<?php
							$result = mysql_query($sentenciaSQL,$link);
							while ($row = mysql_fetch_array($result)) {
								printf("
									<option value='%s'>%s</option>	
								",$row["nombre"],$row["nombre"]);
							}
						?>

						</select>
						
						<input type="text" name="nombre" id="nombre" placeholder="Nombre" data-clear-btn="true" data-inline="true" >
						<input type="text" name="apellido" id="apellido" placeholder="Apellido" data-clear-btn="true"  data-inline="true">
						<input type="password" name="pin" id="pin" placeholder="PIN" data-clear-btn="true">
						<input type="text" name="idAdmin" id="idAdmin" placeholder="ID de usuario" data-clear-btn="true">
						<input type="password" name="claveAdmin" id="claveAdmin" placeholder="Clave" data-clear-btn="true">
					</div>
				</div>

				<?php
					mysql_free_result($result);
					mysql_close($link);
				?>

				<div data-role="controlgroup" data-type="horizontal">
					<a href="javascript:window.history.back();" data-role="button" data-icon="arrow-l"  >Cancelar</a>
					<input type="reset" name="clear" value="Limpiar" data-icon="delete">
					<input type="submit" name="guardar" value="Guardar" data-icon="check" >
				</div>	
			</div>
		</form>
	</div>
	<div data-role="footer" class="ui-bar" data-position="fixed" data-iconpos="left">
		<a data-icon="info">Acerca de</a>
	</div>
</div>
</body>
</html>