<?php
	include 'resources/config.php';
	include 'resources/connectDb.php';
	$data = $_REQUEST;
	$consulta = $DB->Execute('select * from rubros where id=?', $data['id']);
	echo json_encode($consulta->fields, JSON_FORCE_OBJECT);		
	
?>

