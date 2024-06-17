<?php 

$rutaArchivo=$_POST['data'];

# Obtener nombre sin ruta completa, únicamente para sugerirlo al guardar
$nombreArchivo = basename($rutaArchivo);

# Algunos encabezados que son justamente los que fuerzan la descarga
header("Content-disposition: attachment; filename=$nombreArchivo");
# Leer el archivo y sacarlo al navegador
readfile($rutaArchivo);
# No recomiendo imprimir más cosas después de esto

?>