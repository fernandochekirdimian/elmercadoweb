<html>
<head><title></title></head>
<body>
<table border="0" cellpadding="0" cellspacing="0" align="left" style="padding-bottom : 10px; width : 500px;">
	<thead align="left">
		<tr><td align="center" style="vertical-align : middle;" class="td_cabeza">Renovar Aviso</td></tr>
	</thead>
	<tbody>
		<tr>
			<td align="center" class="td_formulario" >
<?php
	import_request_variables("GPC");
	$referencia = $_GET["referencia"];

	$sql = "SELECT * FROM AVISOS WHERE AV_REF='$referencia';";
	$consulta = mysql_query($sql);
	$numero = mysql_num_rows($consulta);
	if ($numero != 0){
		$sql_update = "UPDATE AVISOS SET AV_FECHA = CURDATE(), AV_ALTA=1 WHERE AV_REF = '$referencia';";
		$consulta_update = mysql_query($sql_update);
		echo "Muchas gracias por renovar su aviso.\nRealice el pago del aviso dentro de las 48 horas de haber iniciado\nla renovacion. En caso contrario dich renovacion sera cancelado.";
	}else{
		echo "El aviso no esta cargado o bien a sido dado de baja";
	}
?>
<br>
				<input type="button" value="Volver" class="input" onclick = "javascript:recuperarPagina('docs/renovar_aviso.php');" id="btVolver" onmouseover="javascript:colorearBotones(this.id);" onmouseout="javascript:decolorearBotones(this.id)">
			</td>
		</tr>
	</tbody>
</table>
</body>
</html>
