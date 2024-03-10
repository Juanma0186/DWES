<?php
session_start();
require 'Database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars($_POST['username']); // Filtrar entrada
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (username, password) VALUES (?, ?)";
    $stmt= $pdo->prepare($sql);
    $stmt->execute([$username, $password]);
    $user_id = $pdo->lastInsertId();
    $_SESSION['user_id'] = $user_id;
    $_SESSION['username'] = $username;

    $_SESSION['mensaje'] = 'Usuario registrado con éxito';
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>Document</title>
</head>
<body>
<form method="post" action="registrar.php">
    <label for="username">Nombre de usuario:</label><br>
    <input type="text" id="username" name="username"><br>
    <label for="password">Contraseña:</label><br>
    <input type="password" id="password" name="password"><br>
    <input type="submit" value="Registrar">
</form>
<p><a href="iniciar_sesion.php">Inicia sesión</a></p>
</body>
</html>