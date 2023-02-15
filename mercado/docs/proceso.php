<HTML>
<HEAD>
</HEAD>
<BODY>

<?php
	require_once("fzo.mail.php");
	$mail = new SMTP("localhost",$_POST['usuario'],$_POST['passwd']);
	
	$nombre = $_POST['nombre'];
	$de = $_POST['decorreo'];
	$desnombre = $_POST['desnombre'];
	$a = $_POST['acorreo'];	
	$asunto = $_POST['asunto'];
	$cc = "";
	$bcc = "";
	$cuerpo = $_POST['mensaje'];
	$ib = $_POST['id'];

	$message .= "<html>\n";
	$message .= "<body style=\"font-family:Verdana, Verdana, Geneva, sans-serif; font-size:14px; color:#666666;\">\n";
	$message .= "<div style=\"height:200px;\"><img src=\"www.elmercadoweb.com.ar/logo1.jpg\" width=\"358\" height=\"150\"><br></div>\r\n";
	$message .= "<br><br><b>$desnombre:</b><br>\n";
	$message .= "<br>\n";
	$message .= "Mira este aviso en ";
	$message .= "<a href='www.elmercadoweb.com.ar/index.html?id=$ib' target='_blanck'>elmercadoweb.com.ar</a>\r\n ";
	$message .= "que<br>te puede interesar.<br><br>Saludos";
	$message .= "<br><br>\n";
	$message .= "<b>$nombre</b>\n";
	$message .= "</body>\n";
	$message .= "</html>\n";

	$header = $mail->make_header($de, $a, $asunto, 3, $cc, $bcc);
	$header .= "Content-Type: text/html; charset=UTF-8\n";
	$header .= "Content-Transfer-Encoding: 8bit\n\n";
 	$error = $mail->smtp_send($de, $a, $header, $message, $cc, $bcc);

	if ($error == "0"){
		echo 'Su E-Mail ha sido enviado correctamente\nMuchas gracias\n<center><input class="input" type="buttom" id="cerrar" name="cerrar" value="Cerrar Ventama" onmouseover="javascript:colorearBotones(this.id);" onmouseout="javascript:decolorearBotones(this.id)" onclick="window.close();"></center>';
	}else{
		echo 'No se ha podido enviar correctamente el E-Mail.\nDisculpe. Intente nuevamente.\n<center><input class="input" type="buttom" id="cerrar" name="cerrar" value="Cerrar Ventama" onmouseover="javascript:colorearBotones(this.id);" onmouseout="javascript:decolorearBotones(this.id)" onclick="window.close();"></center>';
	}

?>
</BODY>
</HTML>