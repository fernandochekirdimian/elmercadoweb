<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0.1//EN">
<!-- $Id Exp $ -->
<!--Generated by quanta Plus template - freely use and distribute-->
<html>
<head>
  <title></title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <meta name="GENERATOR" content="Quanta Plus">
  <link>
  <style type="text/css">
  </style>
  <script>
  </script>
</head>
<body>
	<table border="0" cellpadding="0" cellspacing="0" align="left" style="padding-bottom : 10px; width : 500px;">
		<thead align="left">
			<tr><td align="center" style="vertical-align : middle;" class="td_cabeza">Renovar Aviso</td></tr>
		</thead>
		<tbody>
			<tr>
				<td align="left" class="td_formulario" >
					<form name="renovarAviso" method="GET" action="">
						<table cellpadding="2" cellspacing="0" border="0" width="100%">
							<tr>
								<td><label for="referencia">Codigo de Referencia:</label></td>
								<td><input type="text" size="30" maxlength="9" class="input" value="" id="referencia"></td>
							</tr>
							<tr>
								<td align="center" colspan="2" style="padding-top:2px;">
									<input type="button" class="input" value="Renovar" id="btRenovar" onmouseover="javascript:colorearBotones(this.id);" onmouseout="javascript:decolorearBotones(this.id);" onclick="confirmarReno(document.getElementById('referencia').value);">
									<input type="reset" class="input" id="btReset" value="Limpiar" onmouseover="javascript:colorearBotones(this.id);" onmouseout="javascript:decolorearBotones(this.id);">
								</td>
							</tr>
						</table>
					</form>
				</td>
			</tr>
		</tbody>
	</table>
</body>
</html>