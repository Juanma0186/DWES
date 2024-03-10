<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
define('NUM_COLUMNS', 3);
define('NUM_ELEM_POR_PAG', 4);
require 'Database.php';
if (isset($_SESSION['mensaje'])) {
    echo htmlspecialchars($_SESSION['mensaje']);
    unset($_SESSION['mensaje']);
}

if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
    echo "Bienvenido usuario " . $_SESSION['username'] . " (ID: " . $_SESSION['user_id'] . ")";
    echo "<a href='cerrar_session.php'>Cerrar sesión</a>";
} else {
    echo "No has iniciado sesión" . "<br>";
    echo "<a href='iniciar_sesion.php'>Iniciar sesión</a>";
    echo "<a href='registrar.php'>Regístrate</a>";
}

$sql = "SELECT * FROM usuarios WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();



$orderby = isset($_GET['orderby']) && is_numeric($_GET['orderby']) && 1 <= $_GET['orderby'] && $_GET['orderby'] <= NUM_COLUMNS ? $_GET['orderby'] : 1;
$order = isset($_GET['order']) && $_GET['order'] == 'DESC' ? 'DESC' : 'ASC';
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

try {
    $stmt = $pdo->prepare("SELECT  id, nombre , deberes ,fecha_entrega  FROM tareas WHERE user_id = :user_id  ORDER BY :orderby $order LIMIT :limite OFFSET :offset");
    $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
    $stmt->bindParam(':orderby', $orderby, PDO::PARAM_INT);
    $stmt->bindValue(':limite', NUM_ELEM_POR_PAG, PDO::PARAM_INT);
    $stmt->bindValue(':offset', NUM_ELEM_POR_PAG * ($page - 1), PDO::PARAM_INT);
    $stmt->execute();

    $tareas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $total_tareas = $pdo->query('SELECT Count(id) as total from tareas');
    $count = $total_tareas->fetch();
    $count = $count[0];
    $total_paginas = ceil($count / NUM_ELEM_POR_PAG);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

function generateQueryString($orderapintar, $orderby, $order)
{
    if ($orderapintar == $orderby) { // invertir orden
        $neworder = ($order == "ASC") ? "DESC" : "ASC";
        return "?orderby=$orderapintar&order=$neworder";
    } else {
        return "?orderby=$orderapintar&order=ASC";
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

    <?php if (isset($_SESSION['user_id'])): ?>
        <form method="post" action="subir_imagen.php" enctype="multipart/form-data">
            <label for="imagen">Subir nueva imagen de perfil:</label><br>
            <input type="file" id="imagen" name="imagen"><br>
            <input type="submit" value="Subir imagen">
        </form>

        
    <?php endif; ?>

    <?php if (isset($user['imagen'])): ?>
        <img src="<?= $user['imagen'] ?>" alt="Imagen de perfil">
    <?php endif; ?>



    <form method="post" action="insertar.php">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre"><br>
        <label for="deberes">Deberes:</label><br>
        <input type="text" id="deberes" name="deberes"><br>
        <label for="fecha_entrega">Fecha de entrega:</label><br>
        <input type="date" id="fecha_entrega" name="fecha_entrega"><br>
        <input type="submit" value="Insertar">
    </form>


    <table border="1">


        <tr>
            <th><a href="<?= generateQueryString(1, $orderby, $order) ?>">Id</a></th>
            <th><a href="<?= generateQueryString(2, $orderby, $order) ?>">Nombre</a></th>
            <th><a href="<?= generateQueryString(3, $orderby, $order) ?>">Deberes</a></th>
            <th><a href="<?= generateQueryString(4, $orderby, $order) ?>">Fecha de entrega</a></th>
            <th>Borrar</th>
            <th>Editar</th>
        </tr>
        <?php foreach ($tareas as $tarea) { ?>
            <tr>
                <td><?= htmlspecialchars($tarea['id']) ?></td>
                <td><?= htmlspecialchars($tarea['nombre']) ?></td>
                <td><?= htmlspecialchars($tarea['deberes']) ?></td>
                <td><?= htmlspecialchars($tarea['fecha_entrega']) ?></td>
                <td><a href="borrar.php?id=<?= $tarea['id'] ?>">Borrar</a></td>
                <td><a href="editar.php?id=<?= $tarea['id'] ?>">Editar</a></td>
            </tr>
        <?php } ?>


    </table>

    <div class="paginacion">
        <?php for ($i = 1; $i <= $total_paginas; $i++) { ?>
            <span><a <?= ($i == $page) ? "class='actual'" : "" ?> href="?page=<?= $i ?>&orderby=<?= $orderby ?>&order=<?= $order ?>"><?= $i ?></a></span>
        <?php } ?>
    </div>




</body>

</html>