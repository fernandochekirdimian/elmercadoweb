function setCookie(c_name,value,expiredays)
{
	var exdate=new Date()
	exdate.setTime(exdate.getTime()+(60*60*1000))
	document.cookie=c_name+ "=" +escape(value)+((expiredays==null) ? "" : ";expires="+exdate.toGMTString())
}
 
function getCookie(c_name)
{
	if (document.cookie.length>0)
  	{
  		c_start=document.cookie.indexOf(c_name + "=");
  		if (c_start!=-1){ 
    			c_start=c_start + c_name.length+1;
     			c_end=document.cookie.indexOf(";",c_start);
     			if (c_end==-1){ c_end=document.cookie.length; }
     			return unescape(document.cookie.substring(c_start,c_end));
 		} 
   	}
}

function GetXmlHttpObject()
{
	var xmlhttp=false;
	try
	{
		// Creacion del objeto AJAX para navegadores no IE
		xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
	}
	catch(e)
	{
		try
		{
			// Creacion del objet AJAX para IE
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch(E)
		{
			if (!xmlhttp && typeof XMLHttpRequest!='undefined') xmlhttp=new XMLHttpRequest();
		}
	}
	return xmlhttp;
}

var esRegistro;
var esAnuncio;
var xmlHttpDB;
var xmlHttp_busqueda;
var xmlHttp1;

function recuperarPagina(nomPage) {
	if (!nomPage){
		nomPage = 'docs/armarPagPrinAvisos.php';
	}	
	if (nomPage == 'docs/pub_aviso.html'){esRegistro = true;}
	xmlHttp1=GetXmlHttpObject();
	if (xmlHttp1==null)
	{
	alert ("Su navegador no soporta pedidos XML-HTTP.\nPor favor utilice Internet Explorer 5.5 o superior o Mozilla Firefox");
	return
	}
	var url=nomPage;	
	setCookie('pagina_anterior',url,1);
	xmlHttp1.onreadystatechange=cambioEstado; 
	xmlHttp1.open("GET",url,true);
	xmlHttp1.send(null);
	
}

function recuperarPaginaAvisos(nomPage, rubro, subrubro) {
	xmlHttpAvisos=GetXmlHttpObject();
	if (subrubro == "Servicios Hombres y Mujeres"){
		var resp = confirm("ADVERTENCIA:\nEl contenido de esta seccion es solo para mayores de 18 años.\nDesea ingresar?");
		if (resp==false){
			window.location.href='index1.php';
			return;
		}else{
			if (xmlHttpAvisos==null)
			{
				alert ("Su navegador no soporta pedidos XML-HTTP.\nPor favor utilice Internet Explorer 5.5 o superior o Mozilla Firefox");
				return
			}
			var url=nomPage+"?rubro="+rubro+"&subrubro="+subrubro;
			setCookie('pagina_anterior',url,1);
			xmlHttpAvisos.onreadystatechange=cambioEstadoAvisos; 
			xmlHttpAvisos.open("GET",url,true);
			xmlHttpAvisos.send(null);
		}
	}else{
		if (xmlHttpAvisos==null)
		{
		alert ("Su navegador no soporta pedidos XML-HTTP.\nPor favor utilice Internet Explorer 5.5 o superior o Mozilla Firefox");
		return
		}
		var url=nomPage+"?rubro="+rubro+"&subrubro="+subrubro;
		setCookie('pagina_anterior',url,1);
		xmlHttpAvisos.onreadystatechange=cambioEstadoAvisos; 
		xmlHttpAvisos.open("GET",url,true);
		xmlHttpAvisos.send(null);
	}
}

function recuperarPaginaPrincipalAvisos() {	
	xmlHttpAvisos=GetXmlHttpObject();
	if (xmlHttpAvisos==null)
	{
		alert ("Su navegador no soporta pedidos XML-HTTP.\nPor favor utilice Internet Explorer 5.5 o superior o Mozilla Firefox");
		return
	}
	var url='docs/armarPagPrinAvisos.php';	
	setCookie('pagina_anterior',url,1);
	xmlHttpAvisos.onreadystatechange=cambioEstadoPaginaPrincipalAvisos; 
	xmlHttpAvisos.open("GET",url,true);
	xmlHttpAvisos.send(null);
	
}

function recuperarAviso(id) {
	xmlHttpAvisos=GetXmlHttpObject();
	if (xmlHttpAvisos==null)
	{
	alert ("Su navegador no soporta pedidos XML-HTTP.\nPor favor utilice Internet Explorer 5.5 o superior o Mozilla Firefox");
	return
	}
	var url='docs/armarAviso.php';
	url = url+"?id="+id;
	setCookie('pagina_anterior',url,1);
	xmlHttpAvisos.onreadystatechange=cambioEstadoAviso; 
	xmlHttpAvisos.open("GET",url,true);
	xmlHttpAvisos.send(null);
}

function cargarRubros() {	
	xmlHttp1=GetXmlHttpObject();
	if (xmlHttp1==null)
	{
	alert ("Su navegador no soporta pedidos XML-HTTP.\nPor favor utilice Internet Explorer 5.5 o superior o Mozilla Firefox");
	return
	}
	var url='docs/devolver_rubros.php';	
	xmlHttp1.onreadystatechange=cambioEstadoRubro; 
	xmlHttp1.open("GET",url,true);
	xmlHttp1.send(null);
}

function cargarRubrosBusqueda() {	
	xmlHttp_busqueda=GetXmlHttpObject();
	if (xmlHttp_busqueda==null)
	{
	alert ("Su navegador no soporta pedidos XML-HTTP.\nPor favor utilice Internet Explorer 5.5 o superior o Mozilla Firefox");
	return
	}
	var url='docs/devolver_rubros.php';	
	xmlHttp_busqueda.onreadystatechange=cambioEstadoRubroBusqueda; 
	xmlHttp_busqueda.open("GET",url,true);
	xmlHttp_busqueda.send(null);
}

// function cargarRubrosAnuncio() {	
// 	xmlHttp1=GetXmlHttpObject();
// 	if (xmlHttp1==null)
// 	{
// 	alert ("Su navegador no soporta pedidos XML-HTTP.\nPor favor utilice Internet Explorer 5.5 o superior o Mozilla Firefox");
// 	return
// 	}
// 	var url='docs/devolver_rubros.php';	
// 	xmlHttp1.onreadystatechange=cambioEstadoRubroAnuncio; 
// 	xmlHttp1.open("GET",url,true);
// 	xmlHttp1.send(null);
// }

function cargarCostosRubros(nomRubro) {
	xmlHttp2=GetXmlHttpObject();
	if (xmlHttp2==null)
	{
	alert ("Su navegador no soporta pedidos XML-HTTP.\nPor favor utilice Internet Explorer 5.5 o superior o Mozilla Firefox");
	return
	}
	var url='docs/devolver_costos_rubros.php?';	
	url =url+"nomRubro="+nomRubro;
	xmlHttp2.onreadystatechange=cambioEstadoCostosRubro; 
	xmlHttp2.open("GET",url,true);
	xmlHttp2.send(null);
}

function cargarSRubros(rubid) {	
	xmlHttp1=GetXmlHttpObject();
	if (xmlHttp1==null)
	{
	alert ("Su navegador no soporta pedidos XML-HTTP.\nPor favor utilice Internet Explorer 5.5 o superior o Mozilla Firefox");
	return
	}
	var url='docs/devolver_subrubros.php?';
	url = url+"rubId="+rubid;	
	xmlHttp1.onreadystatechange=cambioEstadoSRubro; 
	xmlHttp1.open("GET",url,true);
	xmlHttp1.send(null);
}

function agregarDB(cli_nombre, cli_apellido, cli_domicilio, cli_telefono, cli_celular, cli_mail, cli_provincia, cli_ciudad, cli_cp, cli_pubMail, cli_pubTel, cli_pubCel, cli_pubDom, rub_id, sr_id, av_fp, av_titulo, av_texto, av_coment, av_alta, av_pubpag, av_mandar, av_precio, av_tienefotos, dc_endom, dc_enlocal, dc_domcobro, dc_horcobro, dc_encaja, dc_costo, horario_mail){	
	xmlHttpDB=GetXmlHttpObject();
	if (xmlHttpDB==null)
	{
	alert ("Su navegador no soporta pedidos XML-HTTP.\nPor favor utilice Internet Explorer 5.5 o superior o Mozilla Firefox");
	return
	}
	var url='docs/agregar_db.php';
	var url = url +"?cli_nombre="+cli_nombre+"&cli_apellido="+cli_apellido+"&cli_domicilio="+cli_domicilio+"&cli_telefono="+cli_telefono+"&cli_celular="+cli_celular+"&cli_mail="+cli_mail+"&cli_provincia="+cli_provincia+"&cli_ciudad="+cli_ciudad+"&cli_cp="+cli_cp+"&cli_pubMail="+cli_pubMail+"&cli_pubTel="+cli_pubTel+"&cli_pubCel="+cli_pubCel+"&cli_pubDom="+cli_pubDom+"&rub_id="+rub_id+"&sr_id="+sr_id+"&av_fp="+av_fp+"&av_titulo="+av_titulo+"&av_texto="+av_texto+"&av_coment="+av_coment+"&av_alta="+av_alta+"&av_pubpag="+av_pubpag+"&av_mandar="+av_mandar+"&av_precio="+av_precio+"&av_tienefotos="+av_tienefotos+"&dc_endom="+dc_endom+"&dc_enlocal="+dc_enlocal+"&dc_domcobro="+dc_domcobro+"&dc_horcobro="+dc_horcobro+"&dc_encaja="+dc_encaja+"&dc_costo="+dc_costo+"&horario_mail="+horario_mail;
	xmlHttpDB.onreadystatechange=cambioEstadoAgregarDB; 
	xmlHttpDB.open("GET",url,true);
	xmlHttpDB.send(null);
}

function agregarDB_anuncio(nombre_empresa, nombre_responsable,direccion, provincia, telefono, mail, horario, celular, comentario){
	xmlHttpDB=GetXmlHttpObject();
	if (xmlHttpDB==null)
	{
	alert ("Su navegador no soporta pedidos XML-HTTP.\nPor favor utilice Internet Explorer 5.5 o superior o Mozilla Firefox");
	return
	}
	var url='docs/agregar_db_anuncio.php';
	var url = url+"?nombre_empresa="+nombre_empresa+"&nombre_responsable="+nombre_responsable+"&direccion="+direccion+"&provincia="+provincia+"&telefono="+telefono+"&mail="+mail+"&horario="+horario+"&celular="+celular+"&comentario="+comentario;
	xmlHttpDB.onreadystatechange=cambioEstadoAgregarDBAnuncio; 
	xmlHttpDB.open("GET",url,true);
	xmlHttpDB.send(null);

}

function guardarPref(cli_id, rub_id, borrar){
	xmlHttp1=GetXmlHttpObject();
	var url='guardar_pref.php';
	var url = url+"?cli_id="+cli_id+"&rub_id="+rub_id+"&borrar="+borrar;
	xmlHttp1.onreadystatechange=cambioEstadoGuardarPref; 
	xmlHttp1.open("GET",url,true);
	xmlHttp1.send(null);
}

function agregarRegistro(cli_nombre, cli_apellido, cli_domicilio, cli_telefono, cli_celular, cli_mail, cli_contra, cli_provincia, cli_ciudad, horcobro, esreg, cp, domcobro, cli_cobrar){		
	xmlHttpDB=GetXmlHttpObject();
	if (xmlHttpDB==null)
	{
	alert ("Su navegador no soporta pedidos XML-HTTP.\nPor favor utilice Internet Explorer 5.5 o superior o Mozilla Firefox");
	return
	}
	var url='docs/agregar_cli_reg.php';
	var url = url +"?cli_nombre="+cli_nombre+"&cli_apellido="+cli_apellido+"&cli_domicilio="+cli_domicilio+"&cli_telefono="+cli_telefono+"&cli_celular="+cli_celular+"&cli_mail="+cli_mail+"&cli_contra="+cli_contra+"&cli_provincia="+cli_provincia+"&cli_ciudad="+cli_ciudad+"&horcobro="+horcobro+"&esreg="+esreg+"&cp="+cp+"&domcobro="+domcobro+"&cobrar="+cli_cobrar;
	xmlHttpDB.onreadystatechange=cambioEstadoAgregarRegisto; 
	xmlHttpDB.open("GET",url,true);
	xmlHttpDB.send(null);
}

function cambioEstado() 
{ 
	if (xmlHttp1.readyState==4 || xmlHttp1.readyState=="complete")
		{
			document.getElementById("contenido").innerHTML=xmlHttp1.responseText;
			if (esRegistro){
				cargarRubros();
				esRegistro = false;
			}
		} 	
}

function cambioEstadoAvisos() 
{ 
	if (xmlHttpAvisos.readyState==4 || xmlHttpAvisos.readyState=="complete")
		{
			document.getElementById("contenido").innerHTML=xmlHttpAvisos.responseText;
		} 	
}

function cambioEstadoAviso() 
{ 
	if (xmlHttpAvisos.readyState==4 || xmlHttpAvisos.readyState=="complete")
		{	
			document.getElementById("contenido").innerHTML=xmlHttpAvisos.responseText;
		} 	
}

function cambioEstadoPaginaPrincipalAvisos(){
	if (xmlHttpAvisos.readyState==4 || xmlHttpAvisos.readyState=="complete")
 		{	
			document.getElementById("contenido").innerHTML=xmlHttpAvisos.responseText;
		}
}


function cambioEstadoAgregarDB(){
	if (xmlHttpDB.readyState == 4 || xmlHttpDB.readyState == "complete")
		{
			alert(xmlHttpDB.responseText);
			document.forms['nuevo_aviso'].reset();
// 			window.location.reload();

			
		} 	
}

function cambioEstadoAgregarDBAnuncio(){
	if (xmlHttpDB.readyState == 4 || xmlHttpDB.readyState == "complete")
		{
			alert(xmlHttpDB.responseText);
			document.forms['nuevo_anuncio'].reset();
// 			window.location.reload();
		} 	
}
function cambioEstadoRubro(){
	if (xmlHttp1.readyState==4 || xmlHttp1.readyState=="complete")
		{	
			oListaRub = new Object();
			oListaRub = document.getElementById("spanrubro");
			oListaRub.innerHTML = "";
			oListaRub.innerHTML = "<select name=\"rubro\" id=\"rubro\" style=\"width:230px;\" onchange=\"javascript:subRubros();\"><option>Seleccione un rubro</option>"+xmlHttp1.responseText+"</select>";
			document.getElementById("nombre").focus();
		} 	
}
function cambioEstadoRubroBusqueda(){
	if (xmlHttp_busqueda.readyState==4 || xmlHttp_busqueda.readyState=="complete")
		{
			oListaRub1 = document.getElementById("spanrubroBuscar");
			oListaRub1.innerHTML = "";
			oListaRub1.innerHTML = "<select id=\"rubroBuscar\" style=\"width:150px;\"><option value=\"todo\">Todos los rubros</option>"+xmlHttp_busqueda.responseText+"</select>";
		} 	

}

// function cambioEstadoRubroAnuncio(){
// 	if (xmlHttp1.readyState==4 || xmlHttp1.readyState=="complete")
// 		{
// 			oListaRub = document.getElementById("rubanuncio");
// 			oListaRub.innerHTML = "<option>Todos los rubros</option>"+xmlHttp1.responseText;
// 		} 	
// 
// }

function cambioEstadoCostosRubro(){
	if (xmlHttp2.readyState==4 || xmlHttp2.readyState=="complete")
		{
			document.getElementById("costos").innerHTML = xmlHttp2.responseText;
			costoPrincipal = document.getElementById("costoRubro").value;
			document.getElementById("costo").value = "$ " + String(costoPrincipal);
		} 	
}

function cambioEstadoSRubro(){
	if (xmlHttp1.readyState==4 || xmlHttp1.readyState=="complete")
		{
			oListaSRub = document.getElementById("spansubrubro");
			oListaSRub.innerHTML = "";
			oListaSRub.innerHTML = "<select name=\"subrubro\" id=\"subrubro\" style=\"width:230px;\" >"+xmlHttp1.responseText+"</select>";
		} 	
}

function cambioEstadoGuardarPref(){
	if (xmlHttp1.readyState==4 || xmlHttp1.readyState=="complete")
		{
			return true;
		} 	


}

function cambioEstadoAgregarRegisto(){
	if (xmlHttpDB.readyState == 4 || xmlHttpDB.readyState == "complete")
		{
			alert(xmlHttpDB.responseText);
			document.forms['nuevo_registro'].submit();
			window.location.href='index1.php';
		} 	
}


  /***********************/
 /*Registro de Clientes*/
/*********************/
var xmlDocument;

function leer(mail, contra){
	var XMLHttpRequestObject;
	if (window.ActiveXObject){
		try { XMLHttpRequestObject = new ActiveXObject("Msxml2.XMLHTTP");}
		catch(e) { XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP"); }
	}else{ 
		if (window.XMLHttpRequest){
			XMLHttpRequestObject = new XMLHttpRequest();
			XMLHttpRequestObject.overrideMimeType("text/xml");
			mozillaFlag = true;
		}
   	}	
	if(XMLHttpRequestObject){
		var url='docs/devolver_cliente.php';
		var url = url+"?mail="+mail+"&contra="+contra;
		XMLHttpRequestObject.open("GET", url , true);
		XMLHttpRequestObject.onreadystatechange = function(){
		if (XMLHttpRequestObject.readyState == 4 || XMLHttpRequestObject.readyState == "complete"){	
			var xmlDocument = XMLHttpRequestObject.responseXML;
			res = xmlDocument.getElementsByTagName("resultado");
			if (res.length == 0){
				nom = xmlDocument.getElementsByTagName("valor");
				for (i=0;i<nom.length;i++){
					atributos = nom[i].attributes;
					label = atributos.getNamedItem("id");
					if (label.nodeValue == "nombre"){
						document.getElementById("nombre").value = nom[i].firstChild.data;
					}
					if (label.nodeValue == "apellido"){
						document.getElementById("apellido").value = nom[i].firstChild.data;
					}
					if (label.nodeValue == "domicilio"){
						document.getElementById("domicilio").value = nom[i].firstChild.data;
					}
					if (label.nodeValue == "telefono"){
						document.getElementById("telefono").value = nom[i].firstChild.data;
					}
					if (label.nodeValue == "celular"){
						document.getElementById("celular").value = nom[i].firstChild.data;
					}
					if (label.nodeValue == "provincia"){
						document.getElementById("provincia").value = nom[i].firstChild.data;
					}
					if (label.nodeValue == "ciudad"){
						document.getElementById("ciudad").value = nom[i].firstChild.data;
					}
					if (label.nodeValue == "cp"){
						document.getElementById("cp").value = nom[i].firstChild.data;
					}
					if (label.nodeValue == "email"){
						document.getElementById("email").value = nom[i].firstChild.data;
					}
					if (label.nodeValue == "horario"){
						oSelect = document.getElementById("horcobro");
	// 					oSelect.disabled = false;
						for (j=0;j<oSelect.length;j++){
							if (oSelect.options[j].value == nom[i].firstChild.data){
								oSelect.selectedIndex = j;
								document.getElementById("horario_m").value = oSelect.options[oSelect.selectedIndex].text;
							}
						}
					}
					if (label.nodeValue == "domCobro"){
						document.getElementById("dc_domcobro").value = nom[i].firstChild.data;
					}
					
				}
				document.getElementById('accion').value = 'Ya soy un cliente registrado'
				document.getElementById('accion').style.visibility='visible';
				document.getElementById('accion').style.position = "relative";
				document.getElementById('areaRegistrado').style.visibility='hidden';
				document.getElementById('areaRegistrado').style.position='absolute';
				document.getElementById('rubro').focus();
			}else{alert("Lo sentimos el cliente que desea buscar no existe.\nDisculpe");
				document.getElementById('dirEmail').focus();
				}
		}
	}	
	}	
	XMLHttpRequestObject.send(null);
	
}

function confirmarReno(ref){
	xmlHttp1=GetXmlHttpObject();
	var url='docs/confirma_renova.php';
	var url = url+"?referencia="+ref;
	xmlHttp1.onreadystatechange=cambioEstadoRenova; 
	xmlHttp1.open("GET",url,true);
	xmlHttp1.send(null);
}

function cambioEstadoRenova(){
	if (xmlHttp1.readyState == 4 || xmlHttp1.readyState == "complete")
		{
			document.getElementById("contenido").innerHTML=xmlHttp1.responseText;
		} 


}

function confirmarBaja(ref){
	xmlHttp1=GetXmlHttpObject();
	var url='docs/confirma_baja.php';
	var url = url+"?referencia="+ref;
	xmlHttp1.onreadystatechange=cambioEstadoBaja; 
	xmlHttp1.open("GET",url,true);
	xmlHttp1.send(null);
}

function cambioEstadoBaja(){
	if (xmlHttp1.readyState == 4 || xmlHttp1.readyState == "complete")
		{
			document.getElementById("contenido").innerHTML=xmlHttp1.responseText;
		} 


}