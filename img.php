<?php

require 'conexion.php';

$ano_actual = date('Y');
$fecha_actual = date ('m-d');

$sql = "SELECT nombre, fecha FROM usuario WHERE fecha = '$fecha_actual'";
$resultado = mysqli_query($conexion, $sql);



// Cargar imagen
$imagen = imagecreatefromjpeg('template1.jpg');

$ancho = imagesx($imagen);
$alto = imagesy($imagen);

// Color de texto (en este caso, blanco)
$text_color = imagecolorallocate($imagen, 0, 0, 255);
$text_color_date = imagecolorallocate($imagen, 0, 0, 0);

$texto = $nombre;
$fuente = 'ARIALUNI.ttf';
$tamano_fuente = 20;
$texto_ancho = imagettfbbox($tamano_fuente, 0, $fuente, $texto);
$texto_ancho = $texto_ancho[2] - $texto_ancho[0];
// Escribir texto en la imagen (en este caso, el nombre y la fecha)
 //. $fecha;
//$x = ($ancho - $texto_ancho) / 2;

$y = 980;
$bbox = imagettfbbox($tamano_fuente, 0, $fuente, $texto);
$text_width = abs($bbox[4] - $bbox[0]);
$x = ($ancho - $text_width) / 2;

imagettftext($imagen, 60, 0, $x, $y, $text_color, 'ARIALUNI.ttf', $nombre);


imagettftext($imagen, 30, 0, 640, 1390, $text_color_date, 'ARIALUNI.ttf', $fecha);




// Guardar la imagen con un nombre diferente
imagejpeg($imagen, 'imagen.jpg');

// Liberar memoria
imagedestroy($imagen);
?>