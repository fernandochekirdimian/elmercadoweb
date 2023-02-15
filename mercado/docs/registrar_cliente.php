	<link href="../css/estilos.css" rel="stylesheet" type="text/css" />
	<link href="../css/avisos.css" rel="stylesheet" type="text/css" />
	<link href="../css/errors.css" rel="stylesheet" type="text/css" />
	<link href="../css/men_css.css" rel="stylesheet" type="text/css" />	
<?php
	require 'resources/config.php';
	require 'resources/connectDb.php';
	$DB->SetFetchMode(ADODB_FETCH_ASSOC);
	
	$cli_existe = $DB->GetRow('select id from clientes where mail=?', array($_POST['email']) );		
	if (empty($cli_existe)){
		/*Obtengo los valores de los datos de los cliente*/
		$cli_nombre = $_POST["nombre"];
		$cli_apellido = $_POST["apellido"];
		$cli_domicilio = $_POST["domicilio"];
		$cli_telefono = $_POST["telefono"];
		$cli_celular = $_POST["celular"];
		$cli_mail = $_POST["email"];
		$cli_provincia = $_POST["provincia"];
		$cli_ciudad =$_POST["ciudad"];
		$cli_cp = $_POST["cp"];
		if ($_POST["pub_datos"] == "on"){
			$cli_pubMail = 1;
			$cli_pubTel =  1;
			$cli_pubCel = 1;
			$cli_pubDom = 1;
		}else{
			$cli_pubMail = 0;
			$cli_pubTel =  0;
			$cli_pubCel = 0;
			$cli_pubDom = 0;
		}
		$cli_passwd = $_POST['nueva_contra'];
		$consulta = $DB->Execute("INSERT INTO clientes VALUES (null, ?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
		array(
			$cli_nombre, $cli_apellido, $cli_domicilio, $cli_telefono,
			$cli_celular, $cli_mail, sha1($cli_passwd), $cli_provincia, $cli_ciudad,
			$cli_cp, $cli_pubMail, $cli_pubTel, $cli_pubCel, $cli_pubDom
		));
		$cli_id = $DB->Insert_ID();
		$clase = "info";
		$titulo = "Felicitaciones";
		$msj = "Muchas gracias por registrarse en elmercadoweb.com.ar";		
	}else{
		$cli_id = $cli_existe['id'];
		$clase = "warning";
		$titulo = "Atencion";
		$msj = "Usted ya se encuentra registrado en elmercadoweb.com.ar";
	}
	
?>
<div class="msj <?php echo $clase?>">
	<h4><?php echo $titulo?></h4>
	<p>
		<?php echo $msj;?>
		<a href="<?php echo $_HOST;?>" target="_top">Regresar</a>
	</p>
</div>