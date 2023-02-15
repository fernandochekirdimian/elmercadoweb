<?php
	require_once 'docs/resources/connectDb.php';
	require_once 'docs/resources/config.php';
		
?>
	<ul class="menu">
		<?php
			$rubros = $DB->Execute("select * from rubros order by descripcion");			
			foreach ($rubros as $unRubro){
				$subrubros = $DB->Execute("select * from subrubros where rubros_id = ?", $unRubro['id']);				
				if ($subrubros->RecordCount() != 0){
					echo '<li><a>'.$unRubro['descripcion'].'</a>';
					echo "<ul>";
					foreach ($subrubros as $unSubRubro){
						echo '<li><a href="'.$_HOST.'/docs/armarPaginaAvisos.php?r='.$unRubro['id'].'&p=1&sr='.$unSubRubro['id'].'" target="contenido">'
						.$unSubRubro['descripcion'].'</a>';
					}
					echo "</ul>";
				}else{
					echo '<li><a href="'.$_HOST.'/docs/armarPaginaAvisos.php?r='.$unRubro['id'].'&p=1" target="contenido">'.$unRubro['descripcion'].'</a>';
				}
				echo "</li>";				
			}
		?>
	</ul>
