<?php require 'docs/resources/config.php';?>
<html>
<head>
	<link rel="stylesheet" href="css/cabecera.css" type="text/css" />
	<link rel="stylesheet" href="css/estilos.css" type="text/css" />
	<script src="js/funciones.js"></script>
	<script src="js/devolverPagina.js"></script>
	<script src="js/jquery.js"></script>
</head>
<body>
	<div class="logo">
		<a href="contenido.php" target="contenido">
			<img src="imagenes/logo1.jpg" width="358" height="150">
		</a>
	</div>
	<div id="barra_busca" class="barra_busqueda">
		<ul>
			<li><a href="index.php"  target="_top">Categorias</a></li>			
			<li><a href="docs/pub_aviso.php"  target="contenido">Publicar Aviso</a></li>
			<li><a href="docs/form_registro.php" target="contenido">Registrarme</a></li>
			<li><a href="docs/contactos.php" target="contenido" >Contactos</a></li>
			<li><a href="docs/ayuda.php" target="contenido">Como Publicar</a></li>
			<li>	
				<form action="docs/resultadosBusqueda.php" method="get" target="contenido">	
					<input type="text" id="valorBuscar" size="18" value="" placeholder="Buscar" name="param">
					<input type="submit" class="boton-buscar" value="Buscar" />
				</form>
			</li>
		</ul>
	</div>
	<script type="text/javascript">
		$(function(){
			$('#barra_busca ul li a').bind('click', function(){
				$('#barra_busca ul li a').removeClass('active')
				$(this).addClass('active');
			});
		});
	</script>
</body>
</html>
