<?php
session_start();
if (isset($_POST['cerrar_sesion'])) {

    session_destroy();
    unset($_SESSION);
    $_SESSION = [];


    // Borra la cookie
    if (isset($_COOKIE['recuerdame'])) {
        setcookie('recuerdame', '', time() - 3600); 
    }


    header('Location: inicio_sesion.php');
    exit();
}
