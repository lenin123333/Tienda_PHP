<?php

$new_clave =(int) $_REQUEST['clave'];
$new_nombre = $_REQUEST['nombre'];
$new_precio = $_REQUEST['precio'];
$new_cantidad = $_REQUEST['cantidad'];

if($_FILES["imagen"]["name"]!=""){
    $ruta='../data/files/'.$new_clave.'/';
    $archivo = $ruta . $_FILES["imagen"]["name"];
    if (!file_exists($ruta)) {
        mkdir($ruta);
    }
    if (!file_exists($archivo)) {
        $resultado = @move_uploaded_file($_FILES["imagen"]["tmp_name"], $archivo);
    }
    $new_imagen = $_FILES["imagen"]["name"];
}else{
    $new_imagen =="";
}


$origen=fopen("../data/productos.txt","r");
$aux=fopen("../data/temp.txt","a+");

while(!feof($origen)){
    $clave=fgets($origen);
    $nombre=fgets($origen);
    $imagen=fgets($origen);
    $precio=fgets($origen);
    $cantidad = fgets($origen);
    if($new_clave!=$clave){
        fputs($aux,$clave);
        fputs($aux,$nombre);
        fputs($aux,$imagen);
        fputs($aux,$precio);
        fputs($aux,$cantidad);
    }else{

        fputs($aux,$new_clave."\n");
        fputs($aux,$new_nombre."\n");
        if($new_imagen==null){
            fputs($aux,trim($imagen)."\n");
            fputs($aux,$new_precio."\n");
            fputs($aux,$new_cantidad."\n");
          
        }else{
            
            fputs($aux,$new_imagen."\n");
            fputs($aux,$new_precio."\n");
            fputs($aux,$new_cantidad."\n");
        }
        
       
    }
}
fclose($origen);
fclose($aux);
if(file_exists("../data/productos.txt")){
    unlink("../data/productos.txt");
}
rename("../data/temp.txt", "../data/productos.txt");
header( 'Location: ../Views/Admin/Productos_Admin.php');
