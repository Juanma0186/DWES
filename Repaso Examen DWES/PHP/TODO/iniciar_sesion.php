<?php
session_start();
require 'Database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars($_POST['username']); // Filtrar entrada
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]);

    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['mensaje'] = 'Has iniciado sesión con éxito';
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['mensaje'] = 'Nombre de usuario o contraseña incorrectos';
        header("Location: iniciar_sesion.php");
        exit();
    }
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
<form method="post" action="iniciar_sesion.php">
    <label for="username">Nombre de usuario:</label><br>
    <input type="text" id="username" name="username"><br>
    <label for="password">Contraseña:</label><br>
    <input type="password" id="password" name="password"><br>
    <input type="submit" value="Iniciar sesión">

</form>
    <p><a href="registrar.php">Registrarte</a></p>

</body>
</html>