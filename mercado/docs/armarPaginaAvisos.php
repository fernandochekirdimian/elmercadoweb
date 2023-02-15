<!DOCTYPE link PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<link href="../css/estilos.css" rel="stylesheet" type="text/css" />
	<link href="../css/avisos.css" rel="stylesheet" type="text/css" />
	<link href="../css/errors.css" rel="stylesheet" type="text/css" />
	<link href="../css/men_css.css" rel="stylesheet" type="text/css" />		
	<link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="../js/fancybox/source/jquery.fancybox.css" type="text/css" media="screen" />	
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/fancybox/source/jquery.fancybox.pack.js"></script>
	<script src="../js/funciones.js"></script>
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
</head>
<body>
<div class="contenedor-menu">
	<?php include '../menu.php';?>
</div>
<div class="pagina-avisos">
<?php
require 'resources/connectDb.php';
require 'resources/config.php';

$data = $_REQUEST;
$w = 'SELECT * FROM avisos WHERE ';
$rubId = isset($data['r']) ? $w.= 'rubros_id='.$data['r'] : null;
$subRubId = (isset($data['sr']) && $data['sr'] != -1) ? $w .= ' and subrubros_id = '.$data['sr'] : null;
$page = isset($data['p']) ? $w .= ' LIMIT '.((int) ($data['p']-1) * 32).', 32' : '';

$DB->SetFetchMode(ADODB_FETCH_ASSOC);
$result = $DB->Execute($w);


if($result->RecordCount() == 0){
?>
	<div class="msj warning">
		<h4>Atencion!</h4>
		<p>
			Disculpe, no hay avisos publicados en este rubro
			<a href="<?php echo $_HOST;?>" target="_top">Volver</a>
		</p>
	</div>	
<?php 
}else{
?>
	<table border="0" cellpadding="0" cellspacing="0">	
<?php 
	$row = 0;
	echo "<tr>";
	while (!$result->EOF){						
?>		
		<td>
			<?php
				$imagen = $DB->Execute("SELECT * FROM imagenes_avisos WHERE avisos_id=? LIMIT 1", array($result->fields['id']));				
				if ($imagen->fields['url'] != null){
					$url = $imagen->fields['url'];
				}else{
					$url =  $_IMG_TARGET."sinfoto.gif";
				}								
			?>
			<div id="aviso-<?php echo $result->fields['id'];?>" class="aviso">
				<div class="imagen">			
					<a class="fancybox" rel="fancy-<?php echo $result->fields['id'];?>" href="<?php echo '../'.$url?>">
						<img src="<?php echo '../'.$url;?>" />						
					</a>
					<span class="fa fa-search"></span>
				</div>
					<h5>
						<span class="fa fa-caret-right"></span>
						<a href="<?php echo $_HOST?>/docs/verAviso.php?id=<?php echo $result->fields['id'];?>&epp=1" target="_self"><?php echo ucfirst($result->fields['titulo']);?></a>
					</h5>
					<p class="descripcion">
						<?php echo ucfirst(substr(utf8_encode($result->fields['descripcion']), 0,20).'...');?>
					</p>
					<p class="precio">
						<?php if (floatval($result->fields['precio']) != 0){
							echo number_format ( $result->fields['precio'], 2 , "," , "." );
						}else{
							echo $result->fields['precio'];
						}
						?>	
					</p>	
				</div>
		</td>
<?php 	
		$result->MoveNext();
		$row++;
		if ($row == 4){
			echo "</tr><tr>";
			$row = 0; 		
		}			
	}
	if($row < 4){
		echo "</tr>";
	}
}
?>
	</table>
<?php
	if($result->RecordCount() != 0){
		$cantidadFilas = $DB->Execute("SELECT COUNT(*) as cantidad FROM avisos");
		if ($cantidadFilas->fields['cantidad'] > 32){
			$cantidadPaginas = ($cantidadFilas->fields['cantidad'] % 32 != 0) ? round($cantidadFilas->fields['cantidad'] / 32) + 1 : round($cantidadFilas->fields['cantidad'] / 32);
			echo '<div class="paginador">';		
			for ($i = 0; $i<$cantidadPaginas; $i++){
				$cadena = '';
				if ($subRubId != null){
					$cadena = '&sr='.$data['sr'];
				}
				$clase = ($i+1 == $data['p']) ? ' class="current" ' : '';
				echo '<span '.$clase.'><a href="armarPaginaAvisos.php?r='.$data['r'].'&p='.($i+1).$cadena.'">'.($i+1).'</a></span>';
			}
			echo '</div>';
		}
	}
?>
</div>

</body>
</html>