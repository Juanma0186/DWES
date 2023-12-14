<?php
require_once('data.php');

$acceso = 0;
$u = null;

try {
    $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);

    $n = "";
    $p = "";

    if (isset($_POST['enviar'])) {
        $n = $_POST['nombre'];
        $p = $_POST['pass'];

        $consulta = $db->prepare("SELECT id,nombre,perfil_img FROM usuarios WHERE nombre = '$n' and pass = '$p' LIMIT 1");
        $resultado = $consulta->execute();

        print_r($consulta);

        if ($resultado) {
            $u = $consulta->fetch();
            if ($u != null) {
                $id = $u[0];
                $user = $u[1];
                $img = $u[2];
                echo $img;
            }
        }
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
    <title>Document</title>
</head>

<body>
    <?php if ($u != null) { ?>
        <h1>Área secreta</h1>
        <p><?= $id ?></p>
        <p><?= $user ?></p>
        <img src="uploads/<?= $img ?>" alt="<?= $img ?>" />
    <?php } else { ?>
        <h1>User y Password para Área</h1>
        <form action="" method=" post">
            Nombre: <input type="text" name="nombre" value="<?= $n ?>"><br>
            Password: <input type="password" name="pass" value="<?= $p ?>"><br>
            <input type="submit" name="enviar" value="Enviar">
        </form>
    <?php } ?>
</body>

</html>
