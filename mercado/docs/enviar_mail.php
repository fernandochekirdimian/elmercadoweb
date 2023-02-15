<html>
<head>
	<title>Envio de Consulta</title>
	<link href="../css/avisos.css" rel="stylesheet" type="text/css" />
	<link href="../css/errors.css" rel="stylesheet" type="text/css" />
	<script type='text/javascript' src='../js/funciones.js'></script>

	<script>
		var cuenta = 20;		
		var id=window.setInterval('Contar()',1000);

		function contar(){
			cuenta -= 1;
			if (cuenta==0){
				window.clearInterval(id);
				window.close();
			}
		}
		function cerrar(){
			window.close();
		}
	</script>


</head>
<body onload="contar();" style="font-family: 'sans-serif'; font-size:15px;">
<?php
	require 'resources/config.php';
	/*import_request_variables("GPC");
	$nombre = $_GET["nombre"];
	$email = $_GET["email"];
	$mensage = $_GET["consulta"];
	
	$texto_mail = "El Sr/a ".$nombre." tiene la siguiente consulta:\n\t".utf8_encode($mensage)."\nSu direccion de correo para recibir la respuesta es: ".$email;
	
	require("fzo.mail.php");
	$mail_consulta = new SMTP("localhost","info@elmercadoweb.com.ar","perrito07");
	$cc = "";
	$bcc = "";
	$de = "info@elmercadoweb.com.ar";
	$a = "info@elmercadoweb.com.ar";
	$asunto = "Nueva Consula";
	$header = $mail_consulta->make_header($de, $a, $asunto, 3, $cc, $bcc);
	$mail_consulta->smtp_send($de, $a, $header, $texto_mail, $cc, $bcc);*/	
?>
	<div class="msj info">
		<h4>Hemos recibido tu consulta</h4>
		<p>
			<?php echo("Muchas gracias por enviarnos tu cosulta, pronto recibiras una respuesta.");?>
			<a href="<?php echo $_HOST;?>" target="_top">Regresar</a>
		</p>
	</div>

</body>
</html>