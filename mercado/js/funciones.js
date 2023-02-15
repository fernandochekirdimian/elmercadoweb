function habilitarCasillas(sn){	
	if (sn == 0){
		$("#horcobro").attr('disabled', false);
		$("#dc_domcobro").attr('disabled',false);
	}else{
		$("#horcobro").attr('disabled', true);
		$("#dc_domcobro").attr('disabled', true);
	}
 }

function habilitarFotos(idBt,idCk){
	if($('#'+idCk).attr('checked')){
		$('#'+idBt).attr('disabled', false);
	}else{
		$('#'+idBt).attr('disabled', true);
	}
}

function descontarCarac(idTextArea, idResultado, valorMAX){
	auxResult = 0;
	auxText = "";
	auxText = $('#'+idTextArea).val();
	auxResult = valorMAX - auxText.length;
	if (auxResult == valorMAX){
		$('#'+idResultado).html(valorMAX);
	}else{
		if (auxResult == 0){
			alert("Ha superado los "+valorMAX+" caracteres disponibles");
			$('#'+idResultado).html("0");
		}else{
			$('#'+idResultado).html(auxResult);
		}
		
	}
}

function sumarCostoPaginaPrincipal(){
	if (costos == null){
		alert('Por favor seleccione un Rubro');
		$("#pagPrin").attr('checked', false);
		return false;
	}
	costoPrincipal = costos.costo_pp;
	aux = $('#costo').val();
	pos = aux.indexOf('$');		
	aux = aux.substr(pos+1, aux.length);	
	costoActual = Number(aux);	
	if ($("#pagPrin").attr('checked')){		
		costoActual = costoActual+Number(costos.costo_pp);	
	}else{
		costoActual = costoActual-Number(costos.costo_pp);
	}	
	$('#costo').val('$ '+costoActual.toFixed(2));
}

function sumarCosto(id){
	if (costos == null){
		alert('Por favor seleccione un Rubro');
		if (id == ''){
			id = 'pagar_local';
		}		
		$("#"+id).attr('checked', false);
		return false;
	}
	costoPrincipal = 0;
	if ($("#pagPrin").attr('checked')){
		costoPrincipal = costos.costo_pp;
	}
	if (id == ''){
		var numero = Number(costos.costo)+Number(costoPrincipal);	
	}else{
		var numero = Number(costos.costo)+Number(costos[id])+Number(costoPrincipal);
	}
	$('#costo').val('$ ' + numero.toFixed(2));
}

function mostrarCargaImg(){
	mail = $("#mail").val();	
	if (mail != "" ){
		oVentana = new Object();	
		oVentana=window.open('form_subir_img.php?mail='+mail,'Ventana','height=425,width=640');
	}else{
		alert("Por favor complete el campo E-Mail");
	}
}

function colorearRef(id){
	document.getElementById(id).style.background = "#EBE6AD";
}

function decolorarRef(id){
	document.getElementById(id).style.background = "#fff"; /*"#E0FFDF"*/
}

function RubrosAnuncio(id,idComprueba){
	if (document.getElementById(idComprueba).checked){
		document.getElementById(id).disabled = false;
	}else{
		document.getElementById(id).disabled = true;
	}
}

function habilitarPublicacion(){
	if (validar()){
		$("#btPublicar").attr('disabled', false);
	}else{
		$("#btPublicar").attr('disabled', true);
	}
}

function validar(){
  if ( ($('#nombre').val() == "") || ($('#apellido').val() == "") ){
	alert("Por favor complete los datos necesarios.\n Datos Faltantes:\n1 - Nombre\n2 - Apellido");
	return false;
  }
  if (($('#domicilio').val() == "")) {
	alert("Por favor complete los datos necesarios.\nDatos Faltantes:\n1 - Domicilio");
	return false;	
  } 
  return true;    
}

function iluminarcelda(id){
	referencia = 'tit'+id;
	oCelda = document.getElementById(referencia);
	oCelda.style.background = "#E0D6B5";
}

function apagarcelda(id){
	referencia = 'tit'+id;
	oCelda = document.getElementById(referencia);
	oCelda.style.background = "#9E9C70";
}

function habilitarBotonEnviar(id){
	document.getElementById(id).disabled = false;
}

function habilitarConsulta(id){
	nombre = document.getElementById("nombre").value;
	if (nombre != ""){
		document.getElementById(id).disabled = false;
	}else{
		document.getElementById(id).disabled = true;
	}
	
}

function validarConsulta(){
	nombre = document.getElementById("nombre").value;
	if ($('#nombre').val() == ""){
		alert("Por favor escriba su nombre");
		$('#nombre').focus();
		return false;
	}
	if (($("#email").val() == "") || ($("#email").val() == "@")){	
		$("#email").focus();
		return false;
	}
	if ($("#consulta").val() == ""){
		alert("Por favor escriba su consulta");
		$("#consulta").focus();
		return false;
	}	
}

function enviarMail(nombre, email, consulta){
	oVentana = new Object();	
	oVentana=window.open('docs/enviar_mail.php?nombre='+nombre+'&email='+email+'&consulta='+consulta,'E - Mail','height=250,width=400');
	document.forms['consulta_mail'].submit();
	window.location.href='index1.php';	
}

function recomendarAviso(id){
	oVentana = new Object();
	oVentana=window.open('docs/recomendar.php?id='+id,'Ventana','height=450,width=450');
}

function custumizar(){
	if (document.getElementById("esreg").checked){
		document.getElementById("custom").style.visibility="visible";
	}else{
		document.getElementById("custom").style.visibility="hidden";
	}
}

function cambiarImg(id){	
	objeto = document.getElementById('img'+id);
	texto = document.getElementById('s'+id);
	if (document.getElementById(String(id)).checked){
		objeto.src="../imagenes/imagenes_rub_ico/con_selec.jpg";
		texto.style.font = "bold";
	}else{
		objeto.src="../imagenes/imagenes_rub_ico/sin_selec.png";
		texto.style.font = "normal";
	}
}

function habilitarRegistro(){
	oEmail = document.getElementById("email");
	oContra = document.getElementById("nueva_contra");
	oConfirm_Contra = document.getElementById("confirm_contra");
	if (oContra.value == oConfirm_Contra.value){
		if ((oEmail.value != "@") && (oEmail.value != "")){
			document.getElementById("btReg").disabled = false;
			return true;
		}else{
			alert("Por favor escriba su direccion de e-mail");
			oEmail.focus();
			return;
		}
	}else{
		alert("Las claves no concuerdan. Por favor corrijalas.");
		oContra.focus();
		return;
	}
}


function mostrarBuscarReg(){
	$('#areaRegistrado').toggle(function(){
		$('#bt-buscar-cliente').toggle();
	});	
}

function habilitarCobroDom(param){	
	if (param){
		document.getElementById("horcobro").disabled = false;
		document.getElementById("dc_domcobro").disabled = false;
	}else{
		document.getElementById("horcobro").disabled = true;
		document.getElementById("dc_domcobro").disabled = true;
	}

}

function isEmailAddress(nombre_del_elemento)
{
	var s = $('#'+nombre_del_elemento).val();	
	var filter=/^[A-Za-z][A-Za-z0-9_]*@[A-Za-z0-9_]+\.[A-Za-z0-9_.]+[A-za-z]$/;
	if (s.length == 0 ) return true;
	if (filter.test(s)){
		return true;
	}else{
		alert("Ingrese una direccion de correo valida");
		$('#'+nombre_del_elemento).focus();
		return false;
	}
}

function recuperarDatosAviso(){
	var datosCompletos = 0;
	hayErrores = false;
	$('input.requerido').each(function(){
		$(this).removeClass('validate-error');
		if ($(this).val() == ''){
			$(this).addClass('validate-error').attr('placeholder', 'Complete este dato por favor');
			hayErrores = true;
		}
	});
	if (hayErrores){
		$('input.validate-error').first().focus();
		alert('Por favor complete los datos marcados');
		return false;
	}
	
	oCliNombre = document.getElementById("nombre");
	var cli_nombre = oCliNombre.value;	
	
	oCliApellido = document.getElementById("apellido");
	if (oCliApellido.value != ""){var cli_apellido = oCliApellido.value;}else{alert("Por favor escriba su apellido");oCliApellido.focus();return}
	
	oCliDomicilio = document.getElementById("domicilio");
	var cli_domicilio = oCliDomicilio.value;

	oCliTelefono = document.getElementById("telefono");
	var cli_telefono = oCliTelefono.value;
	var cli_celular = document.getElementById("celular").value;

	oCliMail = document.getElementById("email");	
	if (isEmailAddress('mail')){
		var cli_mail = oCliMail.value;
	}else{
		oCliMail.focus();
		return
	}
	

	var cli_provincia = document.getElementById("provincia").value;
	var cli_ciudad = document.getElementById("ciudad").value;
	var cli_cp = document.getElementById("cp").value;
	
	if (document.getElementById("pubMail").checked){var cli_pubMail = 0;}else{var cli_pubMail = 1;}
	if (document.getElementById("pubTel").checked){var cli_pubTel = 0;}else{var cli_pubTel = 1;}
	if (document.getElementById("pubCel").checked){var cli_pubCel = 0;}else{var cli_pubCel = 1;}
	if (document.getElementById("pubDom").checked){var cli_pubDom = 0;}else{var cli_pubDom = 1;}
	
	oRubId = document.getElementById("rubro");
	if (oRubId.selectedIndex != 0){var rub_id = oRubId.selectedIndex;}else{alert("Seleccione un rubro por favor");oRubId.focus();return}

	oSrId = document.getElementById("subrubro");
	var sr_id = oSrId.options[oSrId.selectedIndex].value;

	oAvFp = document.getElementById("formapago");
	if (oAvFp.value != ""){var av_fp = oAvFp.value;}else{var av_fp = "Consultar";}
	
	oAvTitulo = document.getElementById("titulo");
	if (oAvTitulo.value != ""){var av_titulo = oAvTitulo.value;}else{alert("Por favor coloque un titulo para el aviso");oAvTitulo.focus();return}

	oAvTexto = document.getElementById("aviso");
	if (oAvTexto.value != ""){var av_texto = oAvTexto.value;}else{alert("Por favor escriba un texto para su aviso");oAvTexto.focus();return}

	var av_coment = document.getElementById("coment").value;
	var av_alta = 0;

	if (document.getElementById("pagPrin").checked){var av_pubpag = 0;}else{var av_pubpag = 1;}
//		if (document.getElementById("enviarAv").checked){var av_mandar = 0;}else{var av_mandar = 1;}
	var av_mandar = 1;
	var av_precio = document.getElementById("precio").value;
	if (document.getElementById("tienefotos").checked){var av_tienefotos = 0;}else{var av_tienefotos = 1;}
	if (document.getElementById("pagardomicilio").checked){
		var dc_endom = 0				
		if ( document.getElementById("dc_domcobro").value != "" ){
			var dc_domcobro = document.getElementById("dc_domcobro").value;
		}else{
			var dc_domcobro = document.getElementById("domicilio").value;
		}				
		oDcHor = document.getElementById("horcobro");
		var dc_horcobro = oDcHor.options[oDcHor.selectedIndex].value;
		if (document.getElementById("horario_m").value != ""){
			var horario_mail = document.getElementById("horario_m").value;
		}else{
			var horario_mail = oDcHor.options[oDcHor.selectedIndex].value;
		}
		
	}else{
		var dc_endom = 1
		var dc_domcobro = "";
		var dc_horcobro = "";	
	}
	if (document.getElementById("pagaraca").checked){var dc_enlocal = 0;}else{var dc_enlocal = 1;}
	if (document.getElementById("encaja").checked){var dc_encaja = 0;}else{var dc_encaja = 1;}
	var dc_costo = document.getElementById("costo").value;
	agregarDB(cli_nombre, cli_apellido, cli_domicilio, cli_telefono, cli_celular, cli_mail, cli_provincia, cli_ciudad, cli_cp, cli_pubMail, cli_pubTel, cli_pubCel, cli_pubDom, rub_id, sr_id, av_fp, av_titulo, av_texto, av_coment, av_alta, av_pubpag, av_mandar, av_precio, av_tienefotos, dc_endom, dc_enlocal, dc_domcobro, dc_horcobro, dc_encaja, dc_costo, horario_mail);
}

function recuperarAnuncio(){
	nom_emp = document.getElementById("nom_emp").value;
	nom_resp = document.getElementById("nom_resp").value;
	if ((nom_resp == "") || (nom_emp == "")){
		alert("Por favor complete el Nombre de la Empresa o el Nombre del Responsable");
		document.getElementById("nom_emp").focus();
		document.getElementById("btEnviar").disabled = true;
		return;
	}
	dir = document.getElementById("direc").value;
	if (dir == ""){
		alert("Por favor coloque un direccion");
		document.getElementById("direc").focus();
		document.getElementById("btEnviar").disabled = true;
		return
	}
	prov = document.getElementById("prov").value;
	tel = document.getElementById("telefono").value;
	if (tel == "(0342)"){
		alert("Por favor coloque un telefono");
		document.getElementById("telefono").focus();
		document.getElementById("btEnviar").disabled = true;
		return
	}
	mail = document.getElementById("mail").value;
	oHor = document.getElementById("hora");
	hor = oHor.options[oHor.selectedIndex].value;
	cel = document.getElementById("celular").value;
	com = document.getElementById("coment").value;
	agregarDB_anuncio(nom_emp, nom_resp, dir, prov, tel, mail, hor, cel, com);
}

function subRubros(){
	oSelect = document.getElementById("rubro");
	aux = oSelect.selectedIndex;
	
	cargarSRubros(aux);
	cargarCostosRubros(oSelect.options[oSelect.selectedIndex].value);	
}

function prepararAviso(id){
	auxID = 'ref'+ id;	
	oRef = new Object();
	oRef = document.getElementById(auxID);	
	referencia = oRef.value;
	recuperarAviso(referencia);
}

function imprimirPagina(id){
	var resp=confirm("Desea imprimir las imagenes de este aviso?");
	oVentana = new Object();	
	if (resp==true){
		img=0;	
	}else{
		img=1;
	}
	oVentana=window.open('docs/armarAviso_imp.php?id='+id+'&img='+img,'Ventana','height=800,width=600');
}

function verPrecios(){
	oVentana = new Object();
	oVentana=window.open('docs/verprecios.php','Ventana','height=450,width=350');
}

function getCliente(){	
	var params = $('#clienteReg').serialize();
	$.ajax({
		  type: "POST",
		  url: "devolverCliente.php",
		  data: params,
		  dataType: "json",
		  success: function(data){
			  for (key in data){
				  $('#'+key).val(data[key]);				  
			  }
			  if (data['mostrar_mail'] == 1){
				  $('#pubMail').attr('checked', true);
			  }
			  if (data['mostrar_telefono'] == 1){
				  $('#pubTel').attr('checked', true);
			  }
			  if (data['mostrar_celular'] == 1){
				  $('#pubCel').attr('checked', true);
			  }
			  if (data['mostrar_domicilio'] == 1){
				  $('#pubDom').attr('checked', true);
			  }
		  }
	});
}

function devolverRubros(){
	$.ajax({
			type:"POST",
			url:'devolver_rubros.php',  			
			complete: function(data){
				var rubros = jQuery.parseJSON(data.responseText);
				$('#rubro').append('<option value="-1" selected="selected">Seleccione un Rubro</option>');
				$.each(rubros, function(idx){					
					$('#rubro').append('<option value="'+rubros[idx].id+'">'+rubros[idx].desc+'</option>');	
				});
			}  			
	});
	$('#rubro').bind('change', devolverSubrubros);
}

function devolverSubrubros(){
	var params = jQuery.param({id : $('#rubro option:selected').val()});
	$.ajax({
		type:"POST",
		url:'devolver_subrubros.php',
		data: params,
		complete: function(data){
			console.log(data);
			var subrubros = jQuery.parseJSON(data.responseText);
			if (!jQuery.isEmptyObject(subrubros)){
				$('#subrubro').html('');
				$.each(subrubros, function(idx){					
					$('#subrubro').append('<option value="'+subrubros[idx].id+'">'+subrubros[idx].desc+'</option>');	
				});				
				$('#spansubrubro').hide();
				$('#subrubro').show();
			}else{
				$('#spansubrubro').html('No hay Subrubros asociados a este Rubro').show();
				$('#subrubro').hide();
			}
			
		}  			
	});
	$.ajax({
		type:"POST",
		url:'devolver_costos_rubros.php',
		data: params,
		complete: function(data){
			costos = jQuery.parseJSON(data.responseText);
			$('#costo').val('$ '+costos.costo);
		}  			
	});
	
}

function displayDatosDom(param){	
	$("#datosDom").css('display', param);
}

function verificarContrasenia(id1, id2){
	primerClave = $('#'+id1).val();
	sdaClave = $('#'+id2).val();
	if (primerClave != sdaClave){
		$('#'+id2).removeClass('clave-correcta');
		$('#'+id2).addClass('clave-incorrecta');		
	}else{
		$('#'+id2).addClass('clave-correcta');
		$('#'+id2).removeClass('clave-incorrecta');
	}
}