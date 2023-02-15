<?php
function thumbjpeg($imagen,$altura,$prefijo) {
	// Lugar donde se guardarán los thumbnails respecto a la carpeta donde está la imagen "grande".
// 	$dir_thumb = "imagenes_avisos/";
	$imagen	= '../'.$imagen;
	// Prefijo que se añadirá al nombre del thumbnail. Ejemplo: si la imagen grande fuera "imagen1.jpg",
	// el thumbnail se llamaría "tn_imagen1.jpg"
	$prefijo_thumb = $prefijo;
// 	$camino_nombre = explode("/",$imagen);

	// Aquí tendremos el nombre de la imagen.
// 	$nombre = end($camino_nombre);

	// Aquí la ruta especificada para buscar la imagen.
// 	$camino = substr($imagen,0,strlen($imagen)-strlen($nombre));

	// Aquí comprovamos que la imagen que queremos crear no exista previamente
// 	if (!file_exists($camino.$dir_thumb.$prefijo_thumb.$nombre)) {
	$img = imagecreatefromjpeg($imagen);

	// miramos el tamaño de la imagen original...
	$datos = getimagesize($imagen);

		// intentamos escalar la imagen original a la medida que nos interesa
	$ratio = ($datos[1] / $altura);
	$anchura = round($datos[0] / $ratio);

		// esta será la nueva imagen reescalada
	$thumb = imagecreatetruecolor($anchura,$altura);

		// con esta función la reescalamos
	imagecopyresampled ($thumb, $img, 0, 0, 0, 0, $anchura, $altura, $datos[0], $datos[1]);

		// voilà la salvamos con el nombre y en el lugar que nos interesa.
	imagejpeg($thumb,"../imagenes_avisos/".$prefijo.".jpg");
// 	}
	return "imagenes_avisos/".$prefijo.".jpg";
}

?>
