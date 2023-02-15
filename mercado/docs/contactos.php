<html>
<head>
	<title></title>
  	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<link rel="stylesheet" href="../css/estilos.css" type="text/css" />
	<link rel="stylesheet" href="../css/gstyle_buttons.css" type="text/css" />
	<link href="../css/errors.css" rel="stylesheet" type="text/css" />
	<link href="../css/men_css.css" rel="stylesheet" type="text/css" />		
	<link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<script src="../js/jquery/jquery-1.8.3.js"></script>
	<script src="../js/funciones.js"></script>
</head>
<body >
	<div class="contenedor-menu">
		<?php include '../menu.php';?>
	</div>
	<div class="contenedor-formulario">
		<div class="area-login">
			<div>
				<h5 class="titulo-cabecera">Dejenos su consulta</h5>
			</div>
		</div>
		<form action="enviar_mail.php" method="POST" class="form-nuevo-aviso" style="margin-top:10px">
			<h4>Formulario de Contacto</h4>										
			<fieldset>
				<label for="nombre">Tu Nombre</label>						
				<input type="text" name="nombre" id="nombre" size="21" value="" onblur="habilitarConsulta('btEnviar');">
			</fieldset>
			<fieldset>
				<label for="email">Tu direccion de correo</label>						
				<input type="text" name="email" id="email" size="21" value="@" onblur="return isEmailAddress(this,'email')">
			</fieldset>							
			<fieldset>
				<label for="consulta">Escriba su consulta</label>						
				<textarea name="consulta" id="consulta" style="width:100%;" rows="10"></textarea>
			</fieldset>						
			<fieldset style="text-align: right">
				<input type="submit" class="btn btn-success" value="Enviar Consulta" id="btEnviar"  onclick="validarConsulta();" disabled="true"> 
				<input type="reset" id="btLimpiar" class="btn" value="Limpiar">
			</fieldset>
		</form>							
	</div>	
</body>
</html>