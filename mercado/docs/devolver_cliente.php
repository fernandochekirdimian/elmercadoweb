<?php
	import_request_variables("GPC");
	$email = $_GET["mail"];
	$contra = md5($_GET["contra"]);
	
	$sql = "SELECT * FROM REGISTROS WHERE REG_MAIL = '$email' AND REG_CONTRA = '$contra';";
	$consulta = mysql_query($sql);
	header('Content-Type: text/xml');
	if (mysql_num_rows($consulta) != 0){
		$resultado = mysql_fetch_row($consulta);
		$shows = array(array('nombre'    => $resultado[1],
				'apellido'  => $resultado[2],
				'email'     => $resultado[3],
				'domicilio' => $resultado[5],
				'telefono'  => $resultado[6],
				'celular'   => $resultado[7],
				'provincia' => $resultado[8],
				'ciudad'    => $resultado[9],
				'horario'   => $resultado[10],
				'cp'        => $resultado[12],
				'domCobro'  => $resultado[13])
			);
		
		echo "<?xml version=\"1.0\"?>\n";
		echo  "<registro>\n";
		foreach ($shows as $show){
			echo  "<cliente>\n";
			foreach($show as $tag => $data) {
				echo "<valor id=\"".$tag."\">" . htmlspecialchars($data) . "</valor>\n";
			}	
			echo "</cliente>\n";
		}
		echo  "</registro>";
	}else{		
		echo "<?xml version=\"1.0\"?>\n<resultado>Lo sentimos el cliente no existe</resultado>";
	}
?>