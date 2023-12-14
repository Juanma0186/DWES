<?php

define('NUM_COLUMNS', 3);
define('NUM_ITEMS', 4);
require_once('data.php');

// Comprobamos si se ha enviado el parámetro de la página actual y si es numérico y mayor que 0 y menor que el número de páginas
if (isset($_GET['orderby']) && is_numeric($_GET['orderby']) && $_GET['orderby'] >= 1 && $_GET['orderby'] <= NUM_COLUMNS) {
    $orderby = $_GET['orderby'];
} else {
    $orderby = 1;
}

if (isset($_GET['order'])) {
    if ($_GET['order'] == 'ASC') {
        $order = 'ASC';
    } else {
        $order = 'DESC';
    }
} else {
    $order = 'ASC'; //Orden Default
}

if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

try {
    //Abrimos la base de datos
    $db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);

    //Usamos un operador ternario para asignar la columna a ordenar
    $columna = $orderby == 1 ? 'id' : ($orderby == 2 ? 'nombre' : 'calorias');
    //Preparamos la consulta
    $consulta = $db->prepare("SELECT id, nombre, calorias FROM Comida ORDER BY $orderby $order LIMIT :limite OFFSET :offset");
    //Asignamos los parámetros
    $offset = NUM_ITEMS * ($page - 1);
    $itemsPage = NUM_ITEMS;
    $consulta->bindParam(':limite', $itemsPage, PDO::PARAM_INT);
    $consulta->bindParam(':offset', $offset, PDO::PARAM_INT);

    //Ejecutamos la consulta
    $consulta->execute();
    //Guardamos los datos en un array asociativo con fetchAll(PDO::FETCH_ASSOC)
    $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);

    //Preparamos la consulta para contar el número de registros
    $consulta_count = $db->query("SELECT COUNT(id) AS N FROM Comida");
    //Ejecutamos la consulta
    $count = $consulta_count->fetch();
    //Guardamos el número de registros en $count usando el alias N ya que solo tiene una columna
    $count = $count['N'];
    //Calculamos el número de páginas
    $num_pages = ceil($count / NUM_ITEMS);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    //Si hay algún error, salimos del script con die()
    die();
}

//Función para generar la query string
function generateQueryString($orderAPintar, $orderby, $order)
{
    if ($orderAPintar == $orderby) { //Invertimos el orden
        $newOrder = ($order == 'ASC') ? 'DESC' : 'ASC';
        return "?orderby=$orderby&order=$newOrder";
    } else {
        return "?orderby=$orderAPintar&order=ASC"; //Orden Default
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Listado</title>
</head>

<body>
    <div class="container">
        <table>
            <thead>
                <th><a href="<?= generateQueryString(1, $orderby, $order) ?>">ID</a></th>
                <th><a href="<?= generateQueryString(2, $orderby, $order) ?>">Nombre</a></th>
                <th><a href="<?= generateQueryString(3, $orderby, $order) ?>">Calorias</a></th>
            </thead>
            <tbody>
                <?php foreach ($datos as $dato) { ?>
                    <tr>
                        <td><?= $dato['id'] ?></td>
                        <td><a href="detalle.php?id=<?= $dato['id'] ?>"><?= $dato['nombre'] ?></a></td>
                        <td><?= $dato['calorias'] ?></td>
                    </tr>

                <?php } ?>
            </tbody>
        </table>
        <div class="paginacion">
            <?php for ($i = 1; $i <= $num_pages; $i++) { ?>
                <a <?= ($i == $page) ? "class='actual'" : "" ?> href="?page=<?= $i ?>&orderby=<?= $orderby ?>&order=<?= $order ?>"><?= $i ?></a>
            <?php } ?>
        </div>
    </div>
</body>

</html>
