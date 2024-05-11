<?php
$nombre=$_REQUEST['nombre'];
$apellido=$_REQUEST['apellido'];
$correo=$_REQUEST['correo'];
$contraseña=$_REQUEST['contraseña'];



$leer = fopen('../data/usuarios.txt', 'r');
while (!feof($leer)) {

    $nombre_doc = fgets($leer);
    $apellido_doc = fgets($leer);
    $correo_doc=fgets($leer);
    $contraseña_doc= fgets($leer);
    $tipoUsuario = fgets($leer);
    echo   $correo_doc;
    echo   $correo;
    if (trim($correo_doc) === $correo) {
        //Si es igual detiene el While y mistras lo siguiente
        header( 'Location: ../Views/Auth/Registrar.php?error="encontrado"');
       return;
    }
}

//Si no existe guarda
$guardar=fopen('../data/usuarios.txt','a+');
fputs($guardar,$nombre."\n".$apellido."\n".$correo."\n".$contraseña."\n"."\n"."1"."\n");
fclose($guardar);
header( 'Location: ../Views/Productos.php') ;

?>