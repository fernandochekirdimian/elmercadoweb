<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0.1//EN">
<html>
<head>
  <title>Agregar Imagenes al aviso</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <link href="../css/estilos.css" rel="stylesheet" type="text/css" />  
  <link href="../css/avisos.css" rel="stylesheet" type="text/css" />
  <link href="../css/errors.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="../css/gstyle_buttons.css" type="text/css" />	
  <script type='text/javascript' src='../js/funciones.js'></script>
  <style type="text/css">
  	
  </style>
  <script>
  </script>
</head>
<body>
<?php
	import_request_variables("GPC");
	$mail = $_GET["mail"];	
?>
<div id="cargaDeImg" align="left">	
	<form enctype="multipart/form-data" action="subearchivo.php" method="POST" class="form-nuevo-aviso" style="margin-top:0">
	<h4>Por favor elija las 3 imagenes que desea agregar a su aviso:</h4>
	<p>Tama&ntilde;o m&aacute;ximo de las fotograf&iacute;as: 1 MB </p>	
	<fieldset>
		<label for="imagen1">Imagen 1
			<span style="font-size:12px;display: inline;
float: right;">(La primer imagen que se cargue sera la que se presentara en el resumen del aviso)</span>
		</label>
		<input id="imagen1" name="imagen1" id="subir" type="file" />
	</fieldset>
	<fieldset>
		<label for="imagen2">Imagen 2:</label>
		<input id="imagen2" name="imagen2" id="subir" type="file" />
	</fieldset>
	<fieldset>
		<label for="imagen3">Imagen 3:</label>
		<input id="imagen3" name="imagen3" id="subir" type="file" />
	</fieldset>
	<fieldset style="text-align:right">
		<input type="submit" value="Subir Fotos" id="subir" class="btn btn-success" />
		<input type="reset" value="Limpiar" class="btn btn-warning" id="limpiar" />
		<input type="button" value="Cancelar" class="btn btn-danger" id="cancelar"  onclick="window.close()" />
	</fieldset>
		<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
		<input type="hidden" value="<?php echo substr($mail, 0, strpos($mail, '@')) ?>" name="eMail">
	</form>
</div>
</body>
</html>