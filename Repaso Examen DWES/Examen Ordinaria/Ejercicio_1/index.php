<?php

require_once('data.php');

// Creamos un array de errores
$errores = [];

// Mensaje que mostraremos
$msg = "";

// Variables que usaremos
$nombre = "";
$descripcion = "";
$anno = "";
$estilo = "";

// Hacemos la conexión

try {
  $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Capturar errores

} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
  die();
}

if (isset($_POST['submit'])) {

  // Comprobaciones del nombre
  if (isset($_POST['nombre']) && $_POST['nombre'] != '') {
    if (strlen($_POST['nombre']) >= 2) {
      $nombre = htmlspecialchars($_POST['nombre']);
    } else {
      $errores['nombre'] = 'El nombre deberá tener más de 2 caracteres';
    }
  } else {
    $errores['nombre'] = 'El nombre es obligatorio';
  }

  // Comprobaciones de la descripción
  if (isset($_POST['descripcion']) && $_POST['descripcion'] != '') {
    if (strlen($_POST['descripcion']) >= 5) {
      $descripcion = htmlspecialchars($_POST['descripcion']);
    } else {
      $errores['descripcion'] = 'La descripción deberá ser mayor a 5 caracteres';
    }
  } else {
    $errores['descripcion'] = 'La descripción es obligatoria';
  }

  // Comprobaciones del año
  if (isset($_POST['anno']) && $_POST['anno'] != '') {
    $fechaActual = getdate();
    $annoActual = $fechaActual['year'];
    $annoInput = date('Y', strtotime($_POST['anno']));
    if ($annoInput <= $annoActual) {
      $anno = date('Y', strtotime($_POST['anno']));
    } else {
      $errores['anno'] = 'El año no puede ser mayor al actual';
    }
  } else {
    $errores['anno'] = 'El año es obligatorio';
  }

  // Comprobaciones del estilo
  if (isset($_POST['estilo']) && $_POST['estilo'] != '') {
    $estilo = htmlspecialchars($_POST['estilo']);
  }

  // En caso de que no haya errores
  if (empty($errores)) {

    // Preparamos la consulta
    $consulta = $db->prepare('INSERT INTO edificios (nombre, descripcion, anno, estilo) VALUES (?,?,?,?)');

    // Ejecutamos la consulta
    if ($consulta->execute([$nombre, $descripcion, $anno, $estilo])) {
      $msg = "Insert realizado con ÉXITO";
      header('Location: index.php');
    } else {
      $msg = "Ha habido un error al procesar, prueba de nuevo";
    }
  }
}

// Mostramos el listado
$consultaDatos = $db->prepare('SELECT nombre, descripcion, anno, estilo FROM edificios');
$consultaDatos->execute();
$datos = $consultaDatos->fetchAll();

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edificios Históricos</title>
  <style>
    .error {
      color: red;
    }

    .success {
      color: green;
    }

    form {
      display: flex;
      flex-direction: column;
      width: 50%;
      margin: 0 auto;
    }
  </style>
</head>

<body>
  <?php if ($msg != "" && empty($errores)) { ?>
    <p class="success"><?= $msg ?></p>
  <?php } ?>
  <form action="" method="post">
    <?php if (isset($errores['nombre'])) { ?>
      <span class='error''><?= $errores['nombre'] ?></span>
      <?php } ?>
    <label for="nombre">
      Nombre:
      <input type="text" name="nombre" id="nombre" value="<?= $nombre ?>"/>
    </label>
    <?php if (isset($errores['descripcion'])) { ?>
      <span class=' error''><?= $errores['descripcion'] ?></span>
    <?php } ?>
    <label for="descripcion">
      Descripción:
      <textarea name="descripcion" id="descripcion" cols="30" rows="5" value="<?= $descripcion ?>"></textarea>
    </label>
    <?php if (isset($errores['anno'])) { ?>
      <span class='error''><?= $errores['anno'] ?></span>
    <?php } ?>
    <label for="anno">
      <input type="date" name="anno" id="anno" value="<?= $anno ?>" />
    </label>
    <label for="estilo">
      Estilo:
      <input type="text" name="estilo" id="estilo" value="<?= $estilo ?>"/>
    </label>
    <button type="submit" name="submit">
      Enviar
    </button>
  </form>

  <br/>

  <?php if (!empty($datos)) { ?>
    <h2>Listado de edificios</h2>
    <table>
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Descripción</th>
          <th>Año</th>
          <th>Estilo</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($datos as $dato) { ?>
          <tr>
            <td><?= $dato['nombre'] ?></td>
            <td><?= $dato['descripcion'] ?></td>
            <td><?= $dato['anno'] ?></td>
            <td><?= $dato['estilo'] ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    <?php } ?>
</body>

</html>
