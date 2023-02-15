<?php
	require 'resources/connectDb.php';
	$DB->SetFetchMode(ADODB_FETCH_ASSOC);
	$consulta = $DB->Execute("select * from rubros");
	$rubros = array();
	if ($consulta){
		while (!$consulta->EOF){
			$rubros[] = array('id' => $consulta->fields['id'], 'desc' => $consulta->fields['descripcion']);
			$consulta->MoveNext();		
		}
	}
	
	echo json_encode($rubros, JSON_FORCE_OBJECT);		
?>