<?php
session_start();
require 'Database.php';

$id = $_GET['id'];

if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Manejar el caso en que no se proporciona el parámetro 'id'
    echo "ID no proporcionado";
    exit;
}
if (!is_numeric($_GET['id'])) {
    // Manejar el caso en que 'id' no es un número
    echo "ID no válido";
    exit;
}
$id = intval($_GET['id']);
if ($id <= 0) {
    // Manejar el caso en que 'id' no es un valor positivo
    echo "ID no válido";
    exit;
}


$sql = "DELETE FROM tareas WHERE id = ?";
$stmt= $pdo->prepare($sql);
$stmt->execute([$id]);
$_SESSION['mensaje'] = 'Tarea borrada con éxito';
header("Location: index.php");
exit();
?>
