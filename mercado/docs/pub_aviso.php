<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0.1//EN">
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
	<script>
	  	var costos;
	  	$(function(){
	  		devolverRubros();
	  	});
	 </script>  
</head>
<body>
	<div class="contenedor-menu">
		<?php include '../menu.php';?>
	</div>
	<div class="contenedor-formulario">
	<div class="area-login">
		<div>
			<h5 class="titulo-cabecera">Publicar un nuevo aviso</h5>
			<a href="ayuda.php" class="icono-ayuda"><span class="fa fa-question-circle"></span></a>
		</div>
		
					<a class="boton button bluebtn" href="javascript:mostrarBuscarReg();" id="bt-buscar-cliente" ><span class="label">Ya soy un cliente registrado</span></a>
					<div id="areaRegistrado">
						<form id="clienteReg">
							<fieldset>
								<label for="reg-mail" class="requerido">E-Mail</label>
								<input type="text" size="30" class="input" value="@" name="reg-mail" id="reg-mail">
							</fieldset>
							<fieldset>
								<label for="reg-pass" class="requerido">Contrase&#241;a</label>
								<input type="password" size="30" maxlength="8" class="input" value="" name="reg-pass" id="reg-pass">
							</fieldset>
							<fieldset>
								<a class="boton button greenbtn" href="javascript:getCliente();"><span class="label">Buscar</span></a>
								<a class="boton button redbtn" href="javascript:mostrarBuscarReg();"><span class="label">Cancelar</span></a>
							</fieldset>
						</form>
					</div>
		</div>
<form name="nuevo_aviso" method="POST" action="agregar_db.php" class="form-nuevo-aviso">
	
	<h4>Datos personales</h4>
						
				<fieldset>
					<label for="nombre" class="requerido">Nombre</label>
					<input type="text" name="nombre" id="nombre" value="" size="25" class="requerido">
				</fieldset>					
				<fieldset>
					<label for="apellido" class="requerido">Apellido</label>
					<input type="text" name="apellido" id="apellido" value="" size="25" class="requerido">
				</fieldset>
				<fieldset>
					<label for="provincia">Provincia</label>
					<input type="text" name="provincia" id="provincia" size="20" value="" placeholder="Santa Fe">
				</fieldset>
				<fieldset>
					<label for="ciudad" class="requerido">Ciudad</label>
					<input type="text" name="ciudad" id="ciudad" size="20" value="" placeholder="La Capital" class="requerido">
				</fieldset>
				<fieldset>
					<label for="codigo_postal">Codigo Postal</label>
					<input type="text" name="cp" id="codigo_postal" size="10" class="input" value="" placeholder="3000">
				</fieldset>
				<fieldset>
					<label for="domicilio" class="requerido">Domicilio</label>
					<input type="text" name="domicilio" id="domicilio" value="" size="25" class="requerido">
				</fieldset>
				<fieldset>
					<label for="telefono">Telefono</label>
					<input type="text" name="telefono" id="telefono" value="" size="20" placeholder="0342-">
				</fieldset>
				<fieldset>
					<label for="celular">Celular</label>
					<input type="text" name="celular" id="celular" value="" size="20" placeholder="0342-">
				</fieldset>
				<fieldset>
					<label for="mail" class="requerido">E-Mail</label>
					<input type="text" name="mail" id="mail" value="" size="30" class="requerido input" onblur="return isEmailAddress('mail')" placeholder="nombre@direccion.com" class="requerido"><br />
					<font size="-3" color="Red"><i>Por favor coloque una direccion de correo valida, en caso contrario, no podra realizar futuras operaciones</i></font>
				</fieldset>
		<h4>Datos del aviso<font size="-3" style="float: right;"><a href="verprecios.php" target="popup" onClick="window.open(this.href, this.target, 'width=350,height=250'); return false;">Ver Precios</a></font></h4>			
				<fieldset>
					<label for="rubro" class="requerido">Rubro</label>
					<select id="rubro" name="rubro" class="requerido"></select>
				</fieldset>
				<fieldset>
					<label for="subrubro" class="requerido">Subrubro</label>
					<span id="spansubrubro" style="font-size:.7em; color:#aaa; font-style: italic;">Para ver la lista de Subrubros seleccione un Rubro por favor</span>
					<select id="subrubro" name="subrubro" style="display:none;" class="requerido"></select>
				</fieldset>
				<fieldset>
					<label for="titulo" class="requerido">Titulo del aviso</label>
					<input type="text" size="25" maxlength="25" value="" id="titulo" name="titulo">
				</fieldset>
				<fieldset>
					<ul style="list-style: none;">
						<li>
							<label class="check">
								<input value="1" type="checkbox" id="pagPrin" name="pag_principal" onclick="sumarCostoPaginaPrincipal();">
								<span></span><p>Publicar mi aviso en la pagina principal<br /><span class="comment">(tiempo de publicaci&oacute;n 5 d&iacute;as)</span></p>
							</label>
						</li>													
					</ul>
				</fieldset>
				<fieldset>
					<label for="aviso" class="requerido">Texto</label>
					<textarea style="width:500px;" rows="10" name="texto"  id="aviso" onkeypress="descontarCarac(this.id, 'caracteres',600)" onblur="javascript:habilitarPublicacion();"></textarea>						
					Usted tiene <span id="caracteres" >600</span> caracteres disponibles
				</fieldset>
				<fieldset>
					<label for="coment">Comentario</label>
					<textarea style="width:500px;" rows="2" id="coment" name="comentario" onkeypress="descontarCarac(this.id, 'caracComent',80)"></textarea><br />
					Usted tiene <span id="caracComent">80</span> caracteres disponibles
				</fieldset>
				<fieldset>
					<ul>
						<li><label class="check"><input type="checkbox" id="pubMail" name="pubMail"><span></span><p>publicar mi mail</p></label></li>
						<li><label class="check"><input type="checkbox" id="pubTel" name="pubTel"><span></span><p>publicar mi telefono</p></label></li>
						<li><label class="check"><input type="checkbox" id="pubCel" name="pubCel"><span></span><p>publicar mi celular</p></label></li>
						<li><label class="check"><input type="checkbox" id="pubDom" name="pubDom"><span></span><p>publicar mi domicilio</p></label></li>
					</ul>
				</fieldset>
				<fieldset>
					<label for="precio">Precio de mi producto</label>
					<input type="text" value="$ 0,00" name="precio" id="precio" size="10" class="input">
				</fieldset>
				<fieldset>
					<label for="formapago">Forma de pago de mi producto</label>
					<input type="text" name="tipo_pago" id="formapago" class="input" size="21"></input>
				</fieldset>				
		<h4>Cobro del aviso</h4>
				<fieldset>
					<label for="costo">Costo del Aviso</label>
					<input type="text" name="costo" id="costo" value="$ 0,00" size="15" class="input" readonly="true" tabindex="-1">
				</fieldset>
				<fieldset>
					<label>Pagare mi aviso</label>						
					<ul style="list-style: none;" id="lugar-de-pago">
						<li>
							<label class="radio"><input type="radio" name="forma_pago" id="pagar_local" value="1" onclick="javascript:sumarCosto('');" onchange="displayDatosDom('none');habilitarCobroDom(false)"><span></span><p>En su local</p></label>
						</li>
						<li>
							<label class="radio"><input type="radio" name="forma_pago" id="costo_domicilio" value="2" onclick="javascript:sumarCosto(this.id);" onchange="displayDatosDom('block');habilitarCobroDom(true)"><span></span><p>En mi domicilio</p></label>
							<fieldset style="display:none;" id="datosDom">
								<label for="dc_domcobro">Domicilio de cobro de su aviso</label>
								<input type="text" size="25" value="" id="dc_domcobro" name="domicilio_cobro" class="input" disabled="true">							
								<label for="horcobro">Horario de cobro de su aviso</label>
								<input type="hidden" size="25" value="" id="horario_m" class="input">
								<select id="horcobro" name="horario_cobro" class="input" style="width:250px;" disabled="true">
									<option value="0810">08:00 - 10:00</option>
									<option value="1012">10:00 - 12:00</option>
									<option value="1618">16:00 - 18:00</option>
									<option value="1820">18:00 - 20:00</option>
								</select>
							</fieldset>
						</li>
					</ul>
				</fieldset>
				<fieldset>
					<label class="check"><input type="checkbox" id="tiene_fotos" name="tiene_fotos" onclick="habilitarFotos('subirFotos', this.id);"><span></span><p>El aviso contendra fotos</p></label>
					<input type="button" value="Subir Fotograf&iacute;as" class="input" disabled="true" id="subirFotos" onclick="mostrarCargaImg();">
					<input type="hidden" name="img_1" value="imagenes_avisos/sinfoto.png" />
					<input type="hidden" name="img_2" value="imagenes_avisos/sinfoto.png" />
					<input type="hidden" name="img_3" value="imagenes_avisos/sinfoto.png" />
				</fieldset>
				<fieldset style="text-align: right;">
					<input type="submit" value="Publicar" class="input" style="width:100px;" 
					id="btPublicar" >&nbsp;
					<input type="reset" value="Limpiar" class="input" style="width:100px;" id="btLimpiar" >
				</fieldset>
		
</form>
  </div>
</body>
</html>