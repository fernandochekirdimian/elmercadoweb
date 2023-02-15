<?php
function thumbjpeg($imagen,$altura,$prefijo) {
	$imagen	= '../'.$imagen;
	$prefijo_thumb = $prefijo;
	$datos = getimagesize($imagen);
 	switch ( $datos[2] ) {
            case IMAGETYPE_GIF:
                $img = imagecreatefromgif($imagen);
            break;
            case IMAGETYPE_JPEG:
                $img = imagecreatefromjpeg($imagen);
            break;
            case IMAGETYPE_PNG:
                $img = imagecreatefrompng($imagen);
            break;
            default:
                return false;
        }	
	$ratio = ($datos[1] / $altura);
	$anchura = round($datos[0] / $ratio);
	$thumb = imagecreatetruecolor($anchura,$altura);
	imagecopyresampled ($thumb, $img, 0, 0, 0, 0, $anchura, $altura, $datos[0], $datos[1]);
	$respuesta="";
	switch ( $datos[2] ) {
            case IMAGETYPE_GIF:
            	imagegif($thumb,"../imagenes_avisos/".$prefijo.".gif");
            	$respuesta = "../imagenes_avisos/".$prefijo.".gif";
            break;
            case IMAGETYPE_JPEG:
            	imagejpeg($thumb,"../imagenes_avisos/".$prefijo.".jpg");
            	$respuesta = "../imagenes_avisos/".$prefijo.".jpg";
            break;
            case IMAGETYPE_PNG:
            	imagepng($thumb,"../imagenes_avisos/".$prefijo.".png");
            	$respuesta = "../imagenes_avisos/".$prefijo.".png";
            break;
            default:
                return false;
        }
	return $respuesta;
}

?>
