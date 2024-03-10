<?php
$nombre = $direccion = $madera = $regalo = $envio = $panecillos = $membrillo = '';
$msg = '';
$errores = [];
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

  // Comprobaciones de la dirección
  if (isset($_POST['direccion']) && $_POST['direccion'] != '') {
    if (strlen($_POST['direccion']) >= 5) {
      $direccion = htmlspecialchars($_POST['direccion']);
    } else {
      $errores['direccion'] = 'La dirección deberá ser mayor a 5 caracteres';
    }
  } else {
    $errores['direccion'] = 'La dirección es obligatoria';
  }

  // Comprobaciones de los checkbox
  if (isset($_POST['madera'])) {
    $madera = 1;
  } else {
    $madera = 0;
  }

  if (isset($_POST['regalo'])) {
    $regalo = 1;
  } else {
    $regalo = 0;
  }

  if (isset($_POST['envio'])) {
    $envio = 1;
  } else {
    $envio = 0;
  }

  if (isset($_POST['panecillos'])) {
    $panecillos = 1;
  } else {
    $panecillos = 0;
  }

  if (isset($_POST['membrillo'])) {
    $membrillo = 1;
  } else {
    $membrillo = 0;
  }

  // En caso de que no haya errores
  if (empty($errores)) {
    $msg = "Gracias por su pedido.";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quesos</title>
  <style>
    .error {
      color: red;
    }

    form {
      display: flex;
      flex-direction: column;
      width: 30%;
    }
  </style>
</head>

<body>
  <h1>Formulario Quesos</h1>
  <form action="" method="post">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" value="<?= $nombre ?>" />
    <?php if (isset($errores['nombre'])) : ?>
      <span class='error'><?= $errores['nombre'] ?></span>
    <?php endif; ?>
    <label for="direccion">Dirección:</label>
    <input type="text" name="direccion" id="direccion" value="<?= $direccion ?>" />
    <?php if (isset($errores['direccion'])) : ?>
      <span class='error'><?= $errores['direccion'] ?></span>
    <?php endif; ?>

    <div>
      <label for="madera">Caja Madera</label>
      <input type="checkbox" name="madera" id="madera" <?= $madera ? 'checked' : '' ?>>
      <label for="regalo">Tarjeta Regalo</label>
      <input type="checkbox" name="regalo" id="regalo" <?= $regalo ? 'checked' : '' ?>>
      <label for="envio">Envío Urgente</label>
      <input type="checkbox" name="envio" id="envio" <?= $envio ? 'checked' : '' ?>>
      <label for="panecillos">Panecillos</label>
      <input type="checkbox" name="panecillos" id="panecillos" <?= $panecillos ? 'checked' : '' ?>>
      <label for="membrillo">Membrillo</label>
      <input type="checkbox" name="membrillo" id="membrillo" <?= $membrillo ? 'checked' : '' ?>>
    </div>

    <button type="submit" name="submit">Realizar Pedido</button>

  </form>
  <?php if (empty($errores)) : ?>
    <p><?= $msg ?></p>
  <?php endif; ?>
</body>

</html>
