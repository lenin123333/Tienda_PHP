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

while(!feof($origen)){
    $clave_doc=fgets($origen);
    $nombre_doc=fgets($origen);
    $imagen_doc=fgets($origen);
    $precio_doc=fgets($origen);
    $cantidad_doc = fgets($origen);
    if($clave_doc==$clave){
        $nombre=$nombre_doc;
        $imagen=$imagen_doc;
        $precio=$precio_doc;
        
    }

}

echo $clave;
echo $nombre;
echo $imagen;
echo $precio;
echo $cantidadComprar;





//Si no existe guarda
$guardar=fopen('carrito.txt','a+');
fputs($guardar,trim($clave)."\n". trim($nombre)."\n".trim($imagen)."\n".trim($precio)."\n".trim($cantidadComprar)."\n");
fclose($guardar);
header( 'Location: ../Views/Venta/Productos.php?error="encontrado"');