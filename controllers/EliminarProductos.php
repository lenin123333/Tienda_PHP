<?php

$eliminar =(int) $_REQUEST['clave'];
        
$origen=fopen("productos.txt","r");
$aux=fopen("temp.txt","a+");
while(!feof($origen)){
    $clave=fgets($origen);
    $nombre=fgets($origen);
    $imagen=fgets($origen);
    $precio=fgets($origen);
    $cantidad=fgets($origen);
    if($eliminar!=$clave){
        fputs($aux,$clave);
        fputs($aux,$nombre);
        fputs($aux,$imagen);
        fputs($aux,$precio);
        fputs($aux,$cantidad);
    }
}
fclose($origen);
fclose($aux);
if(file_exists("productos.txt")){
    unlink("productos.txt");
}
rename("temp.txt", "productos.txt");
header( 'Location: ../Views/Admin/Productos_Admin.php');