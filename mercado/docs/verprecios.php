<html>
<head>
	<title>Listado de Precios</title>
	<link rel="stylesheet" href="../css/estilos.css" type="text/css" />
	<link rel="stylesheet" href="../css/gstyle_buttons.css" type="text/css" />
	<script type='text/javascript' src='../js/funciones.js'></script>
</head>
<body>
<?php
	require_once 'resources/connectDb.php';
	$consulta = $DB->Execute("SELECT descripcion, costo FROM rubros ORDER BY descripcion");
?>
	<div style="font-size:12px;margin-top:0" class="form-nuevo-aviso">
		<h4>Listado de Precios</h4>
		<table cellpadding="0" cellspacing="0" border="1" width="300" style="border: solid #333 1px;
font-size: 12px;width: 100%;margin: 0;">
			<?php		
				while (!$consulta->EOF){
			?>
				<tr>
					<td align="left" ><?php echo ucfirst(strtolower($consulta->fields['descripcion']));?></td>
					<td align="rigth"><?php echo ucfirst(strtolower($consulta->fields['costo']));?></td>
				</tr>
			<?php
					$consulta->MoveNext(); 
				}
			?>
		</table>
		<ul style="font-size:11px;">
			<li>Costo por publicar en Pagina Principal : $ 5.00</li>
			<li>Costo por enviar a Clientes Registrados : $ 1.00</li>
			<li>Costo por Cobro a Domicilio : $ 2.00</li>
		</ul>
		<a class="boton button redbtn" href="javascript:window.close();" style="float:right;"><span class="label">Cerrar</span></a>
	</div>

</body>
</html>