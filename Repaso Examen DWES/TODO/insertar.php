<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require 'Database.php';

if (isset($_SESSION['user_id'])) {
    $id = $_SESSION['user_id'];
} else {
    header("Location: iniciar_sesion.php");
    exit();
}

$nombre = htmlspecialchars($_POST['nombre']);
$deberes = htmlspecialchars($_POST['deberes']);
$fecha_entrega = htmlspecialchars($_POST['fecha_entrega']);

if (empty($nombre) || empty($deberes) || empty($fecha_entrega)) {
    $_SESSION['mensaje'] = 'Todos los campos son obligatorios.';
    header("Location: index.php");
    exit();
}


$sql = "INSERT INTO tareas (nombre, deberes, fecha_entrega, user_id) VALUES (?, ?, ? , ?)";
$stmt= $pdo->prepare($sql);
$stmt->execute([$nombre, $deberes, $fecha_entrega, $id]);

header("Location: index.php");
exit();
?>
