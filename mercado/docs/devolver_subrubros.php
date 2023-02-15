<?php
	require 'resources/connectDb.php';
	$DB->SetFetchMode(ADODB_FETCH_ASSOC);
	$data = $_REQUEST;
	
	$consulta = $DB->Execute("select * from subrubros where rubros_id = ?", array((int) $data['id']));
	$subrubros = array();
	if ($consulta){
		while (!$consulta->EOF){
			$subrubros[] = array('id' => $consulta->fields['id'], 'desc' => $consulta->fields['descripcion']);
			$consulta->MoveNext();		
		}
	}else{
		$subrubros[] = array();
	}
	
	echo json_encode($subrubros, JSON_FORCE_OBJECT);
?>