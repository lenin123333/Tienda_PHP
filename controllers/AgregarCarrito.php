<?php 
session_start();
if ($_SESSION['user'] == "") {
    header('Location: ../Views/Auth/Login.php');
}

$cantidadComprar = (int)$_REQUEST['cantidad'];
$clave = $_REQUEST['clave'];
$nombre;
$imagen;
$precio;
$nuevasLineas = ''; // Variable para almacenar las líneas actualizadas del archivo

$origen = fopen("productos.txt", "r");

while (!feof($origen)) {
    $clave_doc = trim(fgets($origen));
    $nombre_doc = trim(fgets($origen));
    $imagen_doc = trim(fgets($origen));
    $precio_doc = trim(fgets($origen));
    $cantidad_doc = intval(trim(fgets($origen))); // Convertir a entero y limpiar la línea

    if ($clave_doc == $clave && $cantidad_doc>0) {
        $nombre = $nombre_doc;
        $imagen = $imagen_doc;
        $precio = $precio_doc;
        $cantidad_doc -= $cantidadComprar; // Restar la cantidad deseada
    }else{
        return header( 'Location: ../Views/Venta/Productos.php?agreado="error"');
    }
    
    // Agregar las líneas al string $nuevasLineas
    if (!feof($origen)) {
        $nuevasLineas .= $clave_doc . "\n" . $nombre_doc . "\n" . $imagen_doc . "\n" . $precio_doc . "\n" . $cantidad_doc . "\n";
    } else {
        $nuevasLineas .= $clave_doc . "\n" . $nombre_doc . "\n" . $imagen_doc . "\n" . $precio_doc . "\n" . $cantidad_doc;
    }
}

fclose($origen);

// Guardar las líneas actualizadas en el archivo
$guardar = fopen('productos.txt', 'w');
fputs($guardar, $nuevasLineas);
fclose($guardar);

header( 'Location: ../Views/Venta/Productos.php?agreado="success"');
return




//Si no existe guarda
$guardar=fopen('carrito.txt','a+');
fputs($guardar,trim($clave)."\n". trim($nombre)."\n".trim($imagen)."\n".trim($precio)."\n".trim($cantidadComprar)."\n");
fclose($guardar);
