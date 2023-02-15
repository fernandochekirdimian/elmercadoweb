<html>
<head>
	<title></title>
	<link rel="StyleSheet" href="../css/estilos.css" type="text/css" />
	<script type='text/javascript' src='../js/funciones.js'></script>
	<script type="text/javascript">
		function setValues(){			  
			opener.document.nuevo_aviso.img_1.value = document.getElementById("img_0").value;			
			opener.document.nuevo_aviso.img_2.value = document.getElementById("img_1").value;
			opener.document.nuevo_aviso.img_3.value = document.getElementById("img_2").value;
		}
	</script>
</head>
<body>
<?php
include "resources/config.php";
import_request_variables("GPC");
$eMail = $_POST["eMail"];
?>
<?php
$i=0;
foreach ($_FILES as $unaFoto) {
	if ($unaFoto['name'] != ''){
		$filename = date('Ymd_His').'_'.$eMail.'_'.basename( $unaFoto['name']);
		$img_path = $_IMG_TARGET.$filename;
		if(move_uploaded_file($unaFoto['tmp_name'], '../'.$img_path)) {
		?>
			<p class="resultado resultado-ok">EL archivo <?php echo basename( $unaFoto['name']) ?> ha sido subido exitosamente</p>
		<?php		 			
		}else{
		?>
			<p class="resultado resultado-no">Ha ocurrido un error al subir el archivo <?php echo basename( $unaFoto['name']) ?> por favor intentelo nuevamente</p>
		<?php 
			$img_path = $_IMG_TARGET."sinfoto.gif";
		}	
	}else{
		$img_path = $_IMG_TARGET."sinfoto.gif";
	}
	?>
		<input type="hidden" id="<?php echo "img_".$i++; ?>" value="<?php echo $img_path;?>" />
	<?php
}
?>
<input id="btVolver" class="input" type='button' value='Volver al formulario' onclick='setValues();javascript:window.close();' onmouseover="javascript:colorearBotones(this.id);" onmouseout="javascript:decolorearBotones(this.id);">
</body></html>