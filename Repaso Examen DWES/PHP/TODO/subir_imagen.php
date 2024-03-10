<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require 'Database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Manejar la subida de la imagen
    $imagen = $_FILES['imagen']['name'];
    $ruta = 'imagenes/' . $imagen;

    // Crear la carpeta si no existe
    if (!file_exists('imagenes')) {
        mkdir('imagenes', 0777, true);
    }

    // Validar el tipo de archivo (no permitir .exe, .tgz, .zip, .deb)
    $tipoArchivo = pathinfo($ruta, PATHINFO_EXTENSION);
    if ($tipoArchivo == "exe" || $tipoArchivo == "tgz" || $tipoArchivo == "zip" || $tipoArchivo == "deb") {
        $_SESSION['mensaje'] = 'No se permiten archivos .exe, .tgz, .zip, .deb';
        header("Location: index.php");
        exit;
    }

    // Validar si la imagen es real
    if (!getimagesize($_FILES['imagen']['tmp_name'])) {
        $_SESSION['mensaje'] = 'El archivo subido no es una imagen';
        header("Location: index.php");
        exit;
    }

    // Validar el tamaño de la imagen (max 2MB)
    if ($_FILES['imagen']['size'] > 2000000) {
        $_SESSION['mensaje'] = 'La imagen es demasiado grande';
        header("Location: index.php");
        exit;
    }

    // Validar el tipo de imagen (jpg, jpeg, png, gif)
    if ($tipoArchivo != "jpg" && $tipoArchivo != "png" && $tipoArchivo != "jpeg" && $tipoArchivo != "gif") {
        $_SESSION['mensaje'] = 'Solo se permiten imágenes JPG, JPEG, PNG y GIF';
        header("Location: index.php");
        exit;
    }

    // Si la imagen ya existe, agregar un número al final
    $i = 0;
    while (file_exists($ruta)) {
        $i++;
        $ruta = 'imagenes/' . pathinfo($imagen, PATHINFO_FILENAME) . "$i." . $tipoArchivo;
    }
    
    move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);

    $sql = "UPDATE usuarios SET imagen = ? WHERE id = ?";
    $stmt= $pdo->prepare($sql);
    $stmt->execute([$ruta, $_SESSION['user_id']]);

    $_SESSION['mensaje'] = 'Imagen de perfil actualizada con éxito';
    header("Location: index.php");
    exit();
}
?>
