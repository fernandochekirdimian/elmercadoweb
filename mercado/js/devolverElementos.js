/*********************************************************************************************/
/*										JSgenMenu v 0.0.1		 	 	 	 				 */
/*																						 	 */
/*							Desarrollado por Fernando Chekirdimian					 	 	 */
/*							Release : 0.0.1 - Santa Fe - 2007 - GPL					 	 	 */
/*																							 */
/*********************************************************************************************/

/*********************************************************************************************/
/*																							 */
/*								Declaracion de Variables									 */
/*																							 */
/*********************************************************************************************/

/*********************************************************************************************/
/*																							 */
/* 									Variables Globales						 		 		 */
/*																							 */
/*********************************************************************************************/

	var mozillaFlag = false;
	var xmlDocument;
	var oTabla;
	var claseBarra;
	var claseBarraOver
	var claseSubMenu;	
	var claseItems;
	var claseItemsOver;

/*********************************************************************************************/
/*																							 */
/* 									Variables de Funciones					 		 		 */
/*																							 */
/*********************************************************************************************/

	var ocultar = function (){ ocultarSubMenu(); };
	var darColor = function (){ darColorBarra(this.id); };
	var sacarColor = function (){ sacarColorBarra(this.id); };
	var mostrar = function (){ mostrarSubMenu(this.id); }
	var mostrarHijo = function (){ mostrarSubHijo(this.id); }
	var darColorI = function (){ darColorItem(this.id);/*clearTimeout(comienzaTiempo);*/ };
	var sacarColorI = function (){ sacarColorItem(this.id); /*comienzaTiempo = setTimeout("ocultarSubMenu();",500);*/ };

/*********************************************************************************************/
/*																							 */
/*									Declaracion de Funciones 								 */
/*																							 */
/*********************************************************************************************/

/***********************************Funciones de Armado del Menu******************************/

/*********************************************************************************************/
/*																							 */
/* Funcion leerXML : Inicializa un nuevo objeto XmlHttp y devuelve			 		 		 */
/* el contenido del archivo XML																 */
/*																							 */
/*********************************************************************************************/

function leerXML(archivo, orientacion){	
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
		XMLHttpRequestObject.open("GET", archivo, true);
		XMLHttpRequestObject.onreadystatechange = function()
		{
			if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200) 
			{
				xmlDocument = XMLHttpRequestObject.responseXML;					
				if(mozillaFlag){
					removeWhitespace(xmlDocument);
				}
				displayGuest(xmlDocument,orientacion);
			} 
		}
		XMLHttpRequestObject.send(null);
   	}
}

/*********************************************************************************************/
/*																							 */
/* Funcion removeWhitespace : Borra los espacios en blacon existentes en el archivo XML		 */
/*																							 */
/*********************************************************************************************/

function removeWhitespace(xml){
	var loopIndex;
	for (loopIndex = 0; loopIndex < xml.childNodes.length; loopIndex++) 
	{
		var currentNode = xml.childNodes[loopIndex];
		if (currentNode.nodeType == 1)
		{
			removeWhitespace(currentNode);
		}
		if (((/^\s+$/.test(currentNode.nodeValue))) && (currentNode.nodeType == 3))
		{
			xml.removeChild(xml.childNodes[loopIndex--]);
		}
	}
}

/*********************************************************************************************/
/*																							 */
/* Funcion displayGuest : Toma la informacion del paramentro xmldo y construye la barra		 */
/* menu																						 */
/*																							 */
/*********************************************************************************************/

function displayGuest(xmldoc,orientacion){	
	oTabla = devolverTABLA(0,0,0);
	oTabla_Head = devolverTHEAD();
	oTabla_Body = devolverTBODY();
	submenues = xmldoc.getElementsByTagName("menu");
	for (i=0;i<submenues.length;i++){
		atributos = submenues[i].attributes;
		label = atributos.getNamedItem("label");
		accion_menu = atributos.getNamedItem("href");
		hijos = atributos.getNamedItem("hasChild");	
		id = atributos.getNamedItem("id");	
		var oDivMenu = devolverDIV(claseBarra,id.nodeValue);
		oDivMenu.onmousemove = darColor;
		oDivMenu.onmouseout = sacarColor;
		if (hijos.nodeValue == 1){
			oDivMenu.innerHTML = "<a onclick=\""+accion_menu.nodeValue+"\" onmouseover='this.style.color=\"white\"' onmouseout='this.style.color=\"black\"' target=\"contenido\">"+ label.nodeValue +" +</a>";	
		 	oDivMenu.onclick = mostrar; 
		}else{
			oDivMenu.innerHTML = "<a onclick=\""+accion_menu.nodeValue+"\" onmouseover='this.style.color=\"white\"' onmouseout='this.style.color=\"black\"' target=\"contenido\">"+ label.nodeValue +"</a>";	
			oDivMenu.onmouseover = ocultar; 
		}
		oTabla_Data = devolverTDATA();
		oTabla_Data.appendChild(oDivMenu);	
		oTabla_Data_2 = devolverTDATA();
		oTabla_Data_2.id = 'celda_' + id.nodeValue;			
		oTabla_Data_2.className = "filaSubMenu";
		oTabla_Row = devolverTROW();
		oTabla_Row_2 = devolverTROW();
		oTabla_Row.appendChild(oTabla_Data);
		oTabla_Row_2.appendChild(oTabla_Data_2);
		oTabla_Head.appendChild(oTabla_Row);
		oTabla_Head.appendChild(oTabla_Row_2);
	}
	oTabla.appendChild(oTabla_Head);
	oTabla.appendChild(oTabla_Body);
	if (!document.getElementById("posMenu")){
		document.body.appendChild(oTabla);
	}else{
		document.getElementById("posMenu").appendChild(oTabla);
	}
}

/*********************************************************************************************/
/*																							 */
/* Funcion armarMenu2 : Contruye los submenues de primer y segundo nivel					 */
/*																							 */
/*********************************************************************************************/

function armarMenu2(xmldoc, etiqueta, nombre_menu, prefijo){	
	nomItem = xmldoc.getElementsByTagName(etiqueta);
	var oTable = devolverTABLA(0,0,0);
	oTable.style.width = "auto";
	var oTable_Body = devolverTBODY();
	for (j=0;j<nomItem.length;j++){
		atributos_items = nomItem[j].attributes;
		valorPadre = atributos_items.getNamedItem("parent");
		if (valorPadre.nodeValue == nombre_menu){
			accion = atributos_items.getNamedItem("href");
			hijos_sub = atributos_items.getNamedItem("hasChild");
			valorNombre = atributos_items.getNamedItem("label");
			id = atributos_items.getNamedItem("id");
			var oAuxDiv = devolverDIV(claseItems,id.nodeValue);
			oAuxDiv.innerHTML = "<a onclick=\""+accion.nodeValue+"\" target=\"contenido\">"+ valorNombre.nodeValue +"</a>"
			oAuxDiv.onmousemove = darColorI;
			oAuxDiv.onmouseout = sacarColorI;
			oAuxDiv.onclick = ocultar;
			if (hijos_sub.nodeValue == 1){ oAuxDiv.onclick = mostrarHijo; }
			var oTable_Row = devolverTROW();
			var oTable_Row_2 = devolverTROW();
			var oTable_Data = devolverTDATA();	
			var oTable_Data_2 = devolverTDATA();
			oTable_Data_2.id = 'celda_'+ id.nodeValue;	
			oTable_Data.appendChild(oAuxDiv);
			oTable_Row.appendChild(oTable_Data);
			oTable_Row_2.appendChild(oTable_Data_2);
			oTable_Row.className = "filaSubMenu";
			oTable_Body.appendChild(oTable_Row);
			oTable_Body.appendChild(oTable_Row_2);		
		}
	}	
	oTable.appendChild(oTable_Body);
	nuevoId = prefijo + nombre_menu;	
	oDivSubMenu = devolverDIV(claseSubMenu,nuevoId);
	oDivSubMenu.appendChild(oTable);	
	document.getElementById('celda_'+nombre_menu).appendChild(oDivSubMenu);
}

/***************************Funciones de Control de Estado del Menu***************************/

/*********************************************************************************************/
/*																							 */
/* Funcion darColorBarra : Colorea los items de la barra de menu cuando el mouse			 */
/* se encuentra sobre el item																 */
/*																							 */
/*********************************************************************************************/

function darColorBarra(idMenu){
	oItems = document.getElementsByTagName("DIV");
	for (i=0;i<oItems.length;i++){
		oAuxId = oItems[i].id;	
		if (oAuxId == idMenu){
			oItems[i].className = claseBarraOver;
		}
	}
}

/*********************************************************************************************/
/*																							 */
/* Funcion sacarColorBarra : Colorea los items de la barra de menu cuando el mouse			 */
/* se sale del item																			 */
/*																							 */
/*********************************************************************************************/

function sacarColorBarra(idMenu){		
	oItems = document.getElementsByTagName("DIV");		
	for (i=0;i<oItems.length;i++){
		oAuxId = oItems[i].id;
		if (oAuxId == idMenu){
			oItems[i].className = claseBarra;
		}
	}
}

/*********************************************************************************************/
/*																							 */
/* Funcion sacarColorBarra : Colorea los items de los submenues cuando el mouse				 */
/* se encuentra sobre item																	 */
/*																							 */
/*********************************************************************************************/

function darColorItem(idItem){
	oItem = new Object();
	oItem = document.getElementById(idItem);
	oItem.className = claseItemsOver;
}

/*********************************************************************************************/
/*																							 */
/* Funcion sacarColorBarra : Colorea los items de los submenues cuando el mouse				 */
/* se sale del item																			 */
/*																							 */
/*********************************************************************************************/
	
function sacarColorItem(idItem){
	oItem = new Object();
	oItem = document.getElementById(idItem);
	oItem.className = claseItems
}

/*********************************************************************************************/
/*																							 */
/* Funcion mostrarSubMenu : Muestra el primer nivel de submenues							 */
/*																							 */
/*********************************************************************************************/

function mostrarSubMenu(idSubMenu){
	if (!document.getElementById('submenu_'+idSubMenu)){
		armarMenu2(xmlDocument, "submenu", idSubMenu, "submenu_");
	}else{
		document.getElementById('celda_'+idSubMenu).removeChild(document.getElementById('submenu_'+idSubMenu))		
	}
}

/*********************************************************************************************/
/*																							 */
/* Funcion mostrarSubHijo : Muestra el segundo nivel de submenues							 */
/*																							 */
/*********************************************************************************************/

function mostrarSubHijo(idSubHijo){		
	if (!document.getElementById('item_'+idSubHijo)){
		armarMenu2(xmlDocument, "item", idSubHijo, "item_");
	}else{
		document.getElementById('celda_'+idSubHijo).removeChild(document.getElementById('item_'+idSubHijo))		
	}
}

/*********************************************************************************************/
/*																							 */
/* Funcion ocultarSubMenu : Oculta el primer y segundo nivel de submenues					 */
/*																							 */
/*********************************************************************************************/

function ocultarSubMenu(){
	oItems = document.getElementsByTagName("DIV");		
	for (i=0;i<oItems.length;i++){
		oAuxId = oItems[i].id;
		if (oAuxId.substr(0,7) != 'submenu'){
			if (oItems[i].style.visibility == "visible"){oItems[i].style.visibility = "hidden"};
		}
		if (oAuxId.substr(0,4) != 'item'){
			if (oItems[i].style.visibility == "visible"){oItems[i].style.visibility = "hidden"};
		}
	}	
}
/***************************Funciones de que devuelven elementos ******************************/

function devolverDIV(className, id){
	oNuevaDiv = document.createElement("div");
	oNuevaDiv.className = className;
	oNuevaDiv.setAttribute("id",id);
	return oNuevaDiv;
}

function devolverTABLA(cell_p, cell_s, cell_b){
	oNuevaTabla = document.createElement("table");
	oNuevaTabla.setAttribute("cellpadding",cell_p);
	oNuevaTabla.setAttribute("cellspacing",cell_s);
	oNuevaTabla.setAttribute("border",cell_b);
	return oNuevaTabla;
}

function devolverTHEAD(){
	oNuevaHead = document.createElement("thead");
	return oNuevaHead;
}

function devolverTBODY(){
	oNuevaTBody = document.createElement("tbody");
	return oNuevaTBody;
}

function devolverTROW(){
	oNuevaTRow = document.createElement("tr");	
	return oNuevaTRow;
}

function devolverTDATA(){
	oNuevaTData = document.createElement("td");	
	return oNuevaTData;
}

/***************************Funciones init(): inicializa las variables******************************/

function init(cla_barra,cla_barra_o,cla_item,cla_item_o,cla_sub,nombre_archivo,orient){
	claseBarra = cla_barra;
	claseBarraOver = cla_barra_o
	claseItems = cla_item;
	claseItemsOver = cla_item_o;
	claseSubMenu = cla_sub;
	leerXML(nombre_archivo,orient);
}