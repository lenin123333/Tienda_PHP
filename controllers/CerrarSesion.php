<?php

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    $_SESSION = [];
    header('Location: ../Views/Productos.php');
}