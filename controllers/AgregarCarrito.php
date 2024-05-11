<?php 
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: ../Views/Auth/Login.php');
    return;
}

$cantidadComprar = (int)$_REQUEST['cantidad'];
$clave = $_REQUEST['clave'];
$nombre;
$imagen;
$precio;
$nuevasLineas = ''; // Variable para almacenar las líneas actualizadas del archivo

$origen = fopen("../data/productos.txt", "r");

while (!feof($origen)) {
    $clave_doc = trim(fgets($origen));
    $nombre_doc = trim(fgets($origen));
    $imagen_doc = trim(fgets($origen));
    $precio_doc = trim(fgets($origen));
    $cantidad_doc = intval(trim(fgets($origen))); // Convertir a entero y limpiar la línea

    if ($clave_doc == $clave) {
        if($cantidad_doc>0){
            $nombre = $nombre_doc;
            $imagen = $imagen_doc;
            $precio = $precio_doc;
            $cantidad_doc -= $cantidadComprar; // Restar la cantidad deseada
        }else{
            return header( 'Location: ../Index.php?agreado="error"');
        }
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
$guardar = fopen('../data/productos.txt', 'w');
fputs($guardar, $nuevasLineas);
fclose($guardar);


// Abrir el archivo en modo lectura y escritura
$guardar = fopen('../data/carrito.txt', 'r+');

// Variable para controlar si se encuentra el producto
$producto_encontrado = false;

// Variable para almacenar las líneas del archivo
$nuevasLineas = '';

// Iterar sobre el archivo para buscar el producto
while (!feof($guardar)) {
    // Leer la clave guardada del archivo
    $clave_guardada = trim(fgets($guardar));

    if ($clave_guardada == '') {
        // Si llegamos al final del archivo, salir del bucle
        break;
    }

    // Leer las otras líneas del producto
    $nombre_guardado = trim(fgets($guardar));
    $imagen_guardada = trim(fgets($guardar));
    $precio_guardado = trim(fgets($guardar));
    $cantidad_guardada = intval(trim(fgets($guardar)));

    // Si la clave guardada es igual a la clave actual, actualizar la cantidad
    if ($clave_guardada == $clave) {
        $producto_encontrado = true;
        // Agregar la clave y las líneas del producto con la cantidad actualizada
        $nuevasLineas .= $clave_guardada . "\n";
        $nuevasLineas .= $nombre_guardado . "\n"; // Nombre
        $nuevasLineas .= $imagen_guardada . "\n"; // Imagen
        $nuevasLineas .= $precio_guardado . "\n"; // Precio
        $nueva_cantidad = $cantidad_guardada + $cantidadComprar;
        $nuevasLineas .= $nueva_cantidad . "\n"; // Nueva cantidad
    } else {
        // Agregar las líneas del producto sin modificar
        $nuevasLineas .= $clave_guardada . "\n"; // Clave
        $nuevasLineas .= $nombre_guardado . "\n"; // Nombre
        $nuevasLineas .= $imagen_guardada . "\n"; // Imagen
        $nuevasLineas .= $precio_guardado . "\n"; // Precio
        $nuevasLineas .= $cantidad_guardada . "\n"; // Cantidad
    }
}

// Si el producto no se encontró, agregar un nuevo registro al final del archivo
if (!$producto_encontrado) {
    $nuevasLineas .= trim($clave) . "\n" . trim($nombre) . "\n" . trim($imagen) . "\n" . trim($precio) . "\n" . trim($cantidadComprar) . "\n";
}

// Truncar el archivo para eliminar su contenido actual
ftruncate($guardar, 0);

// Colocar el puntero al inicio del archivo
rewind($guardar);

// Escribir las líneas actualizadas en el archivo
fwrite($guardar, $nuevasLineas);

// Cerrar el archivo
fclose($guardar);



header( 'Location: ../Index.php?agreado="success"');