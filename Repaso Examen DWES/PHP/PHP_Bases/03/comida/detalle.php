<?php

require_once('data.php');

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
} else {
    // Log
    header('Location: 404.html');
    die();
}

try {
    $db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
    $consulta = $db->prepare("SELECT * FROM Comida WHERE id = :id");
    $consulta->bindParam(':id', $id, PDO::PARAM_INT);
    $resultado = $consulta->execute();

    if ($resultado) {
        $receta = $consulta->fetch();
    } else {
        $receta = null;
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle </title>
</head>

<body>
    <?php if ($receta == null) { ?>
        <h1>Receta no encontrada</h1>
    <?php } else { ?>
        <h1><?= $receta['nombre'] ?></h1>
        <h2><?= $receta['calorias'] ?></h2>
        <p><?= $receta['receta'] ?></p>
    <?php } ?>
</body>

</html>
