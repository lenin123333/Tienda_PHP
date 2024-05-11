<?php

$correo = $_REQUEST['correo'];
$contraseña = $_REQUEST['contraseña'];

$leer = fopen('../data/usuarios.txt', 'r');


while (!feof($leer)) {

    $nombre_doc = fgets($leer);
    $apellido_doc = fgets($leer);
    $correo_doc = fgets($leer);
    $contraseña_doc = fgets($leer);
    $tipoUsuario = fgets($leer);
    echo   $correo_doc;
    echo   $correo;
    if (trim($correo_doc) === $correo && trim($contraseña_doc) === $contraseña  && trim($tipoUsuario) == "1") {
        //Si es igual detiene el While y mistras lo siguiente
    
        session_start();
        $_SESSION['admin']=trim($tipoUsuario);
        header('Location: ../Views/Admin/Productos_Admin.php');
       
        return;
    } else if (trim($correo_doc) === $correo && trim($contraseña_doc) === $contraseña  && trim($tipoUsuario) == "0") {
       
        session_start();
        $_SESSION['nombre'] = $nombre_doc;
        $_SESSION['apellido'] = $apellido_doc;
        $_SESSION['correo'] = $correo_doc;
        $_SESSION['user']=$tipoUsuario;
        header('Location: ../Views/Venta/Productos.php');
        return;
    }
}

header('Location: ../Views/Auth/Login.php?error="encontrado"');
