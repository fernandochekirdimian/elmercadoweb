<?php
	function generatePassword ($length = 4)
	{
		$password = "";
		$possible = "abcdfghijklmnopqrstuvwxyz"; 
		$i = 0; 
		while ($i < $length) { 
			$char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
			if (!strstr($password, $char)) { 
				$password .= $char;
				$i++;
			}
		}
		$password1 = "";
		$posible = "0123456789";
		$j = 0;
		
		while ($j < $length) { 
			$char1 = substr($posible, mt_rand(0, strlen($posible)-1), 1);
			if (!strstr($password1, $char1)) { 
				$password1 .= $char1;
				$j++;
			}
		}
		return $password.'-'.$password1;
	}
	
	import_request_variables("GPC");
	include("imagen.php");
	require 'resources/config.php';
	require 'resources/connectDb.php';
	$DB->SetFetchMode(ADODB_FETCH_ASSOC);
	
	$cli_existe = $DB->GetRow('select id from clientes where mail=?', array($_POST['mail']) );	
	if (count($cli_existe) == 0){
		/*Obtengo los valores de los datos de los cliente*/
		$cli_nombre = $_POST["nombre"];
		$cli_apellido = $_POST["apellido"];
		$cli_domicilio = $_POST["domicilio"];
		$cli_telefono = $_POST["telefono"];
		$cli_celular = $_POST["celular"];
		$cli_mail = $_POST["mail"];
		$cli_provincia = $_POST["provincia"];
		$cli_ciudad =$_POST["ciudad"];
		$cli_cp = $_POST["cp"];
		$cli_pubMail = isset($_POST["pubMail"]) ? $_POST["pubMail"] : null;
		$cli_pubTel =  isset($_POST["pubTel"]) ? $_POST["pubTel"] : null;
		$cli_pubCel = isset($_POST["pubCel"]) ? $_POST["pubCel"] : null;
		$cli_pubDom = isset($_POST["pubDom"]) ? $_POST["pubDom"] : null;
		$cli_passwd = rand(1000, 9999);
		$consulta = $DB->Execute("INSERT INTO clientes VALUES (null, ?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
		array(
			$cli_nombre, $cli_apellido, $cli_domicilio, $cli_telefono,
			$cli_celular, $cli_mail, $cli_passwd, $cli_provincia, $cli_ciudad,
			$cli_cp, $cli_pubMail, $cli_pubTel, $cli_pubCel, $cli_pubDom
		));
		$cli_id = $DB->Insert_ID();	
	}else{
		$cli_id = $cli_existe['id'];
	}	
	

	/*Obtengo los valores del los datos de los avisos*/
	$rub_id = $_POST["rubro"];
	$subr_id = 1;	
	$av_ref = generatePassword();	
	$av_titulo = $_POST["titulo"];
	$av_desc = $_POST["texto"];
	$av_coment = $_POST["comentario"];	
	$av_pubpag = isset($_POST["pag_principal"]) ? 1 : null;	
	$av_precio = $_POST["precio"];
	$av_forma_pago = $_POST['tipo_pago'];
	$av_forma_cobro = $_POST['forma_pago'];
	$av_costo = $_POST['costo'];
		
	$consulta = $DB->Execute("INSERT INTO avisos VALUES(null,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", 
	array(
		$av_ref, $av_titulo, $av_desc, $av_coment, date('Y-m-d'), 1, $av_pubpag, $av_forma_pago,
		$av_precio, $subr_id, $cli_id, $rub_id, $av_forma_cobro, $av_costo
	));
	$av_id = $DB->Insert_ID();
	
	if (isset($_POST["tiene_fotos"])){
		for ($i = 0; $i < 3; $i++){			
			$av_img_url = $_POST['img_'.($i+1)];			
			$consulta = $DB->Execute("INSERT INTO imagenes_avisos VALUES(null,?,?)", array($av_img_url, $av_id));
		}
	}
	if($av_forma_cobro == 2){
		$dc_domicilio_cobro = $_POST['domicilio_cobro'];
		$dc_horario_cobro = $_POST['horario_cobro'];
		$consulta = $DB->Execute('INSERT INTO datos_cobro VALUES (null, ?, ?, ?, ?)', array($dc_domicilio_cobro,$dc_horario_cobro,	$av_id, $cli_id));			
	}

?>
	<link href="../css/estilos.css" rel="stylesheet" type="text/css" />
	<link href="../css/avisos.css" rel="stylesheet" type="text/css" />
	<link href="../css/errors.css" rel="stylesheet" type="text/css" />
	<link href="../css/men_css.css" rel="stylesheet" type="text/css" />		
	<link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<div class="msj info">
		<h4>Felicitaciones</h4>
		<p>
			<?php echo("Su aviso ha sido registrado con exito!.\nMuchas gracias por confiar en elmercadoweb.com.ar");?>
			<a href="<?php echo $_HOST;?>" target="_top">Regresar</a>
		</p>
	</div>
