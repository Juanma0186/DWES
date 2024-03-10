<?php
session_start();
require 'Database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validar que los campos no estén vacíos
    if (empty($_POST['nombre']) || empty($_POST['deberes']) || empty($_POST['fecha_entrega'])) {
        $_SESSION['mensaje'] = 'Todos los campos son obligatorios.';
        //echo "Todos los campos son obligatorios.";
        header("Location: index.php");
        exit();
    }

    $id = $_POST['id'];

    // Verificar que el usuario autenticado es el propietario de la tarea
    $sql = "SELECT * FROM tareas WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $tarea = $stmt->fetch();

    if ($tarea['user_id'] != $_SESSION['user_id']) {
        echo "No tienes permiso para editar esta tarea";
        exit;
    }

    // Validar la fecha de entrega
    $fecha_entrega = $_POST['fecha_entrega'];
    if (!strtotime($fecha_entrega)) {
        echo "Fecha de entrega no válida.";
        exit;
    }

    // Escapar valores para prevenir XSS
    $nombre = htmlspecialchars($_POST['nombre']);
    $deberes = htmlspecialchars($_POST['deberes']);
    $fecha_entrega = htmlspecialchars($fecha_entrega);

    // Actualizar la tarea
    $sql = "UPDATE tareas SET nombre = ?, deberes = ?, fecha_entrega = ? WHERE id = ?";
    $stmt= $pdo->prepare($sql);
    $stmt->execute([$nombre, $deberes, $fecha_entrega, $id]);

    $_SESSION['mensaje'] = 'Tarea actualizada con éxito';
    header("Location: index.php");
} else {
    $id = $_GET['id'];

    // Verificar que el usuario autenticado es el propietario de la tarea
    $sql = "SELECT * FROM tareas WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $tarea = $stmt->fetch();

    if ($tarea['user_id'] != $_SESSION['user_id']) {
        echo "No tienes permiso para editar esta tarea";
        exit;
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
<form method="post" action="editar.php">
    <input type="hidden" name="id" value="<?= $tarea['id'] ?>">
    <label for="nombre">Nombre:</label><br>
    <input type="text" id="nombre" name="nombre" value="<?= $tarea['nombre'] ?>"><br>
    <label for="deberes">Deberes:</label><br>
    <input type="text" id="deberes" name="deberes" value="<?= $tarea['deberes'] ?>"><br>
    <label for="fecha_entrega">Fecha de entrega:</label><br>
    <input type="date" id="fecha_entrega" name="fecha_entrega" value="<?= $tarea['fecha_entrega'] ?>"><br>
    <input type="submit" value="Guardar cambios">
</form>
</body>
</html>
