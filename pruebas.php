<?php

require 'conexion.php';
echo phpversion();

$sql = "SELECT nombre, fecha FROM usuario WHERE DAY(fecha) = DAY(NOW()) AND MONTH(fecha) = MONTH(NOW())";
$resultado = $mysqli->query($sql);

while ($fila = mysqli_fetch_assoc($resultado)) {
    // Obtener los datos de la fila actual
    $nombre = $fila['nombre'];
    $fecha = $fila['fecha'];
    $ano_actual = date('Y');
    $fecha = date_format(date_create($fecha), "d") . " de " . date_format(date_create($fecha), "F") . " de " . $ano_actual;

    // Cargar imagen
    $imagen = imagecreatefromjpeg('template1.jpg');
    
    // Resto del código para generar la imagen
    $ancho = imagesx($imagen);
    $alto = imagesy($imagen);
    $text_color = imagecolorallocate($imagen, 0, 0, 255);
    $text_color_date = imagecolorallocate($imagen, 0, 0, 0);
    $texto = $nombre;
    $fuente = 'ARIALUNI.ttf';
    $tamano_fuente = 20;

    $texto_ancho = imagettfbbox($tamano_fuente, 0, $fuente, $texto);
    $texto_ancho = $texto_ancho[2] - $texto_ancho[0];

    $tamaño_nombre=
    $x = ($ancho - $texto_ancho) / 2;
    $y = 980;

    imagettftext($imagen, 60, 0, $x, $y, $text_color, 'ARIALUNI.ttf', $nombre);


    imagettftext($imagen, 30, 0, 640, 1390, $text_color_date, 'ARIALUNI.ttf', $fecha);


    // Guardar la imagen con un nombre diferente
    $filename = str_replace(' ', '', $nombre) . '.jpg';
    imagejpeg($imagen, $filename);

    // Liberar memoria
    imagedestroy($imagen);
}

// Liberar resultado de la consulta
mysqli_free_result($resultado);

// Cerrar la conexión a la base de datos
$mysqli->close();

?>