<?php
	import_request_variables("GPC");
	$cli_id = $_GET["cli_id"];
	$rub_id = $_GET["rub_id"];
	$borrar = $_GET["borrar"];

	if ($borrar == 0){
		$sql = "SELECT MAX(PREF_ID) FROM PREFERENCIAS";
		$consulta = mysql_query($sql);
		$numeroFilas = mysql_num_rows($consulta);
		if ($numeroFilas){
			$resultado = mysql_fetch_row($consulta);
			$auxId = $resultado[0] + 1;
		}
		$sql = "INSERT INTO PREFERENCIAS VALUES($auxId, $cli_id, $rub_id);";
		$consulta = mysql_query($sql);
	}else{
		$sql = "DELETE FROM PREFERENCIAS WHERE PREF_CLI_ID=$cli_id AND PREF_RUB_ID=$rub_id;";
		$consulta = mysql_query($sql);	
	}

?>