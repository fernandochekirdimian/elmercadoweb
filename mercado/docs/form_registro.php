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
				<h5 class="titulo-cabecera">Registro de Clientes</h5>
			</div>
		</div>
		<form name="nuevo_registro" method="POST" action="registrar_cliente.php" class="form-nuevo-aviso" style="margin-top:10px">
			<h4>Datos personales</h4>
			<fieldset>
				<label for="nombre" class="requerido">Nombre</label>
				<input type="text" name="nombre" id="nombre" value="" size="30" placeholder="Nombre">
			</fieldset>
			<fieldset>
				<label for="apellido" class="requerido">Apellido</label>
				<input type="text" name="apellido" id="apellido" value="" size="30" class="input" placeholder="Apellido">
			</fieldset>
			<fieldset>
				<label for="email" class="requerido">Correo Electronico</label>
				<input type="text" name="email" id="email" value="@" size="30" onblur="return isEmailAddress(this,'email' )">
			</fieldset>
			<fieldset>
				<label for="nueva_contra" class="requerido">Contrase&#241;a</label>
				<input type="password" maxlength="8" name="nueva_contra" id="nueva_contra" size="30" value="" placeholder="Contrase&ntilde;a">
			</fieldset>
			<fieldset>
				<label for="confirm_contra" class="requerido">Confirmar Contase&#241;a</label>
				<input type="password" maxlength="8" name="confirm_contra" id="confirm_contra" size="30" value="" 
								onblur="javascript:habilitarRegistro();" 
								placeholder="Vuelva a escribir su contrase&ntilde;a" onkeyup="verificarContrasenia('nueva_contra','confirm_contra')">
			</fieldset>
			<fieldset><label for="domicilio">Domicilio</label><input type="text" name="domicilio" id="domicilio" value="" size="30" ></fieldset>
			<fieldset><label for="telefono">Telefono</label><input type="text" name="telefono" id="telefono" value="" size="20"  placeholder="0342 - 4565758"></fieldset>				
			<fieldset><label for="celular">Celular</label><input type="text" name="celular" id="celular" value="" size="20"  placeholder="0342-15-6565758"></fieldset>				
			<fieldset><label for="ciudad">Ciudad</label><input type="text" name="ciudad" id="ciudad" size="20" value="" placeholder="Santa Fe de la Vera Cruz" ></fieldset>
			<fieldset><label for="cp">Codigo Postal</label><input type="text" name="cp" id="cp" size="10" value="" placeholder="3000" class="input"></fieldset>
			<fieldset><label for="procincia">Provincia</label><input type="text" name="provincia" id="provincia" size="20" value="" placeholder="Santa Fe" class="input"></fieldset>
			<fieldset>
				<label for="pub_datos" style="width:100%"><input type="checkbox" id="pub_datos" name="pub_datos">Deseo publicar mis datos en los avisos(Mail - Telefono - Celular - Domicilio)</label>
			</fieldset>						
			<fieldset style="text-align: right;">
				<input type="submit" value="Registrarme" style="width:100px;" id="btReg" disabled="disabled" class="btn btn-success" >
				<input type="reset" value="Limpiar" style="width:100px;" id="btLimpiar" class="btn">
			</fieldset>
				<font color="red" style="font-weigth:bold;">(*)</font>Datos Obligatorios
				<p>Todos los datos son para uso exclusivo de elmercadoweb.com.ar. Por tanto no ser&aacute;n divulgados ni se realizara ninguna comercializaci&oacute;n con ellos</p>					
		</form>
	</div>				
</body>
</html>