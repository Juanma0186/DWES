<?php

require_once('data.php');

try {
    $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);

    $consulta = $db->prepare('SELECT * FROM usuarios');
    $resultado = $consulta->execute();
    $data = $consulta->fetchAll();
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
    <title>Lista usuarios</title>
</head>

<body>
    <?php if ($resultado) { ?>
        <?php foreach ($data as $row) {
            echo htmlspecialchars($row['id']) . " - " . htmlspecialchars($row['nombre']) . " - " . $row['pass'] . " - " . $row['perfil_img'] . "<br>";
        } ?>
    <?php } else { ?>
        <h1>No se han obtenido resultados</h1>
    <?php } ?>
</body>

</html>
