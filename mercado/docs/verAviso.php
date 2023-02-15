<?php
	require 'resources/config.php';
	require 'resources/connectDb.php';			
	$data = $_REQUEST;
	if (isset($data['epp'])){
		$href= '../contenido.php';
	}else{
		$href = "armarPaginaAvisos.php?r=".$data['r']."&p=".$data['p'].(isset($data['sr']) ? "&sr=".$data['sr'] : "");
	}
?>
<!DOCTYPE head PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<link href="../css/estilos.css" rel="stylesheet" type="text/css" />
		<link href="../css/avisos.css" rel="stylesheet" type="text/css" />
		<link href="../css/gstyle_buttons.css" rel="stylesheet" type="text/css" />		
		<link href="../css/errors.css" rel="stylesheet" type="text/css" />
		<link href="../css/men_css.css" rel="stylesheet" type="text/css" />		
		<link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css" />		
		<link rel="stylesheet" href="../js/fancybox/source/jquery.fancybox.css" type="text/css" media="screen" />
		<script type="text/javascript" src="../js/jquery.js"></script>
		<script type="text/javascript" src="../js/fancybox/source/jquery.fancybox.pack.js"></script>		
	</head>
	<body>
		<div class="contenedor-menu">
			<?php include '../menu.php';?>
		</div>
		<div class="pagina-avisos ver-aviso">
		<?php
			$aviso = $DB->Execute("SELECT * FROM avisos WHERE id=?", array($data['id']));
			if (!$aviso){
		?>				
				<div class="msj warning">
					<h4>Atencion!</h4>
					<p>
						Disculpe se ha producido un error al leer el aviso
						<a href="<?php echo $href;?>" target="_self">Volver</a>
					</p>
				</div>
		<?php 
			}else{
				$imagenes = $DB->getAll("SELECT * FROM imagenes_avisos WHERE avisos_id=?", array($aviso->fields['id']));
				$imagenesArray = array();
				if ($imagenes){
				
				foreach ($imagenes as $unaImagen){														
						$imagenesArray[] = '../'.$unaImagen['url'];
				}
				}else{
					$imagenesArray[0] = $_HOST.'/'.$_IMG_TARGET."sinfoto.gif";
					$imagenesArray[1] = $_HOST.'/'.$_IMG_TARGET."sinfoto.gif";
					$imagenesArray[2] = $_HOST.'/'.$_IMG_TARGET."sinfoto.gif";
				}
							
				$cliente = $DB->Execute("SELECT * FROM clientes WHERE id = ?", array($aviso->fields['clientes_id']));		
				$rubro = $DB->Execute("SELECT descripcion FROM rubros WHERE id = ?", array($aviso->fields['rubros_id']));
				if ($aviso->fields['subrubros_id'] != 0){
					$subrubro = $DB->Execute("SELECT descripcion FROM subrubros WHERE id = ?", array($aviso->fields['subrubros_id']));
				}else{
					$subrubro = null;
				}		
		?>
			<!-- <div class="breadcrumb">
				<p>
					<?php 
					echo $rubro->fields['descripcion'];
					echo ($subrubro != null) ? ' > '.$subrubro->fields['descripcion'] : ''; 
					?>
					&#124; <a href="<?php echo $href;?>" target="_self">Volver al listado</a>
				</p>				
			</div>-->
			<div class="datos-avisos">
				<div class="datos">
					<h5>
						<span class="fa fa-caret-right"></span>
						<?php echo ucfirst(strtolower($aviso->fields['titulo']));?>
					</h5>
							
					<p><?php echo ucfirst(strtolower(utf8_encode($aviso->fields['descripcion'])));?></p>
					<ul>
					<li><span class="dato-label">Nombre: </span><?php echo ucfirst(strtolower($cliente->fields['nombre'])); ?></li>
					<li><span class="dato-label">Apellido: </span><?php echo ucfirst(strtolower($cliente->fields['apellido'])); ?></li>
					<li><span class="dato-label">Correo: </span><?php echo strtolower($cliente->fields['mail']); ?></li>
					<li><span class="dato-label">Telefono: </span><?php echo ucfirst(strtolower($cliente->fields['telefono'])); ?></li>
					<li><span class="dato-label">Celular: </span><?php echo ucfirst(strtolower($cliente->fields['celular'])); ?></li>
					</ul>
					<p class="precio">
						<?php echo $aviso->fields['forma_pago']?>:
						<?php if (floatval($aviso->fields['precio']) != 0){
							echo number_format ( $aviso->fields['precio'], 2 , "," , "." );
						}else{
							echo $aviso->fields['precio'];
						}
						?>	
					</p>
				</div>
				<div class="imagen">
					<a href="<?php echo $imagenesArray[0]?>" class="fancybox">
						<img src="<?php echo $imagenesArray[0]?>" />
					</a>
					<span class="fa fa-search"></span>
				</div>
			</div>
			<div class="imagenes-avisos">
				<div class="imagen">
				<a href="<?php echo $imagenesArray[1]?>" class="fancybox">
					<img src="<?php echo $imagenesArray[1]?>" />
				</a>
				<span class="fa fa-search"></span>
				</div>
				<div class="imagen">
				<a href="<?php echo $imagenesArray[2]?>" class="fancybox">
					<img src="<?php echo $imagenesArray[2]?>" />
				</a>
				<span class="fa fa-search"></span>
				</div>
			</div>			
		<?php			
			}
		?>
		</div>
		<script type="text/javascript">		
			$(function() {							
				$('.fancybox').fancybox({
					'href': this.href,
					helpers:  {
				        title:  null
				    }
				});	
				 		
			});
		</script>
	</body>
</html>