<?php 
session_start();
if ($_SESSION['user'] == "") {
    header('Location: ../Views/Auth/Login.php');
}

// Generar un ID único para el archivo de ventas
$unique_id = uniqid();

// Guardar el ID único para usarlo en ambos archivos
$id = $unique_id;

$sumaTotal = (int)$_REQUEST['sumaTotal'];
$origen = fopen("../data/productos.txt", "r");
$nuevasLineas = $unique_id;
while (!feof($origen)) {
    $clave_doc = trim(fgets($origen));
    $nombre_doc = trim(fgets($origen));
    $imagen_doc = trim(fgets($origen));
    $precio_doc = trim(fgets($origen));
    $cantidad_doc = intval(trim(fgets($origen))); // Convertir a entero y limpiar la línea

    if (!feof($origen)) {
        $nuevasLineas .= $clave_doc . "\n" . $nombre_doc . "\n" . $imagen_doc . "\n" . $precio_doc . "\n" . $cantidad_doc . "\n";
    } else {
        $nuevasLineas .= $clave_doc . "\n" . $nombre_doc . "\n" . $imagen_doc . "\n" . $precio_doc . "\n" . $cantidad_doc . "\n" . $sumaTotal . "\n\n";
    }
}

// Obtener el correo electrónico de la sesión
$correo = $_SESSION['correo'];

// Quitar el carácter "@" y cualquier otro carácter no válido para nombres de archivo
$correo_sanitizado = preg_replace('/[^a-zA-Z0-9._-]/', '', $correo);

fclose($origen);

// Ruta del archivo de ventas
$ruta_ventas = '../data/ventas/ventas_'.$correo_sanitizado.'_'. $unique_id .'.txt';

// Ruta del archivo de carrito
$ruta_carrito = '../data/carrito.txt';

// Abrir el archivo de carrito en modo de escritura para limpiarlo
$limpiar_carrito = fopen($ruta_carrito, 'w');

// Verificar si se pudo abrir el archivo de carrito
if ($limpiar_carrito) {
    // Escribir una cadena vacía en el archivo de carrito para ponerlo en blanco
    fwrite($limpiar_carrito, '');

    // Cerrar el archivo de carrito
    fclose($limpiar_carrito);
}

// Abrir el archivo de ventas para escritura
$guardar = fopen($ruta_ventas, 'w');

// Verificar si se pudo abrir el archivo de ventas
if ($guardar) {
    // Escribir las nuevas líneas en el archivo de ventas
    fputs($guardar, $nuevasLineas);

    // Cerrar el archivo de ventas
    fclose($guardar);
 
    header('Location: ../Views/Venta/Carrito.php?agregado=success');

} else {
    header('Location: ../Views/Venta/Carrito.php?agregado=error');
}
?>
