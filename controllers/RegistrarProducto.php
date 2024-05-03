<?php
$clave=(int)$_REQUEST['clave'];
$nombre=$_REQUEST['nombre'];
$precio=$_REQUEST['precio'];
$cantidad=$_REQUEST['cantidad'];

$ruta='files/'.$clave.'/';
$archivo=$ruta.$_FILES["imagen"]["name"];
if(!file_exists($ruta)){
    mkdir($ruta);
}
if(!file_exists($archivo)){
    $resultado=@move_uploaded_file($_FILES["imagen"]["tmp_name"],$archivo);
}
$imagen=$_FILES["imagen"]["name"];


$leer = fopen('productos.txt', 'r');
while (!feof($leer)) {
    $clave_doc= fgets($leer);
    $nombre_doc = fgets($leer);
    $imagen_doc= fgets($leer);
    $precio_doc = fgets($leer);
    $cantidad_doc = fgets($leer);

  
    if (trim($clave_doc) === $clave) {
        //Si es igual detiene el While y mistras lo siguiente
        header( 'Location: ../Views/Admin/Agregar_Productos.php?error="encontrado"');
       return;
    }
}

//Si no existe guarda
$guardar=fopen('productos.txt','a+');
fputs($guardar,$clave."\n".$nombre."\n".$imagen."\n".$precio."\n".$cantidad."\n");
fclose($guardar);
header( 'Location: ../Views/Admin/Productos_Admin.php');

?>
