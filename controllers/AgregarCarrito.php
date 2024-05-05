<?php 

session_start();
if($_SESSION['user']==""  ){
    header('Location: ../Views/Auth/Login.php');
}

$cantidadComprar=(int)$_REQUEST['cantidad'];

$clave=$_REQUEST['clave'];
$nombre;
$imagen;
$precio;


$origen=fopen("productos.txt","r");

while (!feof($origen)) {
    $clave_doc = trim(fgets($origen));
    $nombre_doc = trim(fgets($origen));
    $imagen_doc = trim(fgets($origen));
    $precio_doc = trim(fgets($origen));
    $cantidad_doc = intval(trim(fgets($origen))); // Convertir a entero y limpiar la línea

    if ($clave_doc == $clave) {
        $nombre = $nombre_doc;
        $imagen = $imagen_doc;
        $precio = $precio_doc;
        $cantidad_doc += intval($cantidadComprar); // Sumar la cantidad deseada
    }
}


return



//Si no existe guarda
$guardar=fopen('carrito.txt','a+');
fputs($guardar,trim($clave)."\n". trim($nombre)."\n".trim($imagen)."\n".trim($precio)."\n".trim($cantidadComprar)."\n");
fclose($guardar);
header( 'Location: ../Views/Venta/Productos.php?error="encontrado"');