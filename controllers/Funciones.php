<?php

function is_admin():bool{
    if(!isset($_SESSION)){
        session_start();
    }
    return isset($_SESSION['admin']) && !empty($_SESSION['admin']);
}