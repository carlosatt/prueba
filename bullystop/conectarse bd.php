<?php

function conectarse(){
	if(($link= mysql_connect("sql301.epizy.com","epiz_19133934","lacontra123"))){
		if(mysql_select_db("epiz_19133934_bullystop",$link)){
	    	return $link;
	   	}else {
	    	echo "Error al seleccionar la base de datos";
	   	}
	}else{
		echo "Error al conectarse al servidor de la base de datos";
	}
}

?>