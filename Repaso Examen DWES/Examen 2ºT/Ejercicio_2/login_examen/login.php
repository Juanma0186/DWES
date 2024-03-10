<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include 'Database.php';

$username = '';
$errores = [];


//Conexión BBDD
$db = Database::getInstance();
$connection = $db->getConnection();

if (isset($_POST['submit'])) {

  // Comprobaciones username
  if (isset($_POST['username']) && $_POST['username'] != '') {
    $username = $_POST['username'];
  } else {
    $errores['username'] = 'El usuario es requerido';
  }

  // Comprobaciones de la password
  if (isset($_POST['password']) && $_POST['password'] != '') {
    $password = $_POST['password'];
  } else {
    $errores['password'] = 'La contraseña es requerida';
  }

  if (empty($errores)) {
    $consulta = $connection->prepare('SELECT * FROM usuarios WHERE nombre = ?');
    $consulta->execute([$username]);
    $usuario = $consulta->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify(($password), $usuario['secreto'])) {
      $_SESSION['username'] = $usuario['nombre'];

      // URL de donde vienes
      if (isset($_SESSION['url'])) {
        $url = $_SESSION['url'];
        header("Location: $url");
        exit();
      }
      header('Location: privado.php');
      exit();
    } else {
      $errores['credenciales'] = 'Error';
    }
  }
}

?>
<html>

<head>
  <link rel="stylesheet" type="text/css" media="all" href="css/estilo.css">
</head>

<body>
  <h1>Bienvenido!!</h1>
  <?php include('menu.php') ?>
  <form action="login.php" method="post" class="login">
    <p>
      <label for="login">Nombre:</label>
      <input type="text" name="username" id="login" value="<?= $username ?>">
    <p class="error">
      <?= (isset($errores['username']) ? $errores['username'] : '') ?>
    </p>
    </p>

    <p>
      <label for="password">Password:</label>
      <input type="password" name="password" id="password" value="">
    <p class="error">
      <?= (isset($errores['password']) ? $errores['password'] : '') ?>
    </p>

    </p>

    <?php if (isset($errores['credenciales'])) { ?>
      <div class="error">Error</div>
    <?php } ?>
    </p>

    <p class="login-submit">
      <label for="submit">&nbsp;</label>
      <button type="submit" name="submit" class="login-button">Login</button>
    </p>
  </form>
</body>

</html>
