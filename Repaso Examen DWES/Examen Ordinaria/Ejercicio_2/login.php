<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

include 'Database.php';
$db = Database::getInstance();

$connection = $db->getConnection();


$email = '';
$password = '';
$errores = [];
if (isset($_POST['login'])) {
  if (isset($_POST['email']) && !empty($_POST['email'])) {
    $email = $_POST['email'];
  } else {
    $errores[] = 'El email es requerido';
  }
  if (isset($_POST['password']) && !empty($_POST['password'])) {
    $password = $_POST['password'];
  } else {
    $errores[] = 'El password es requerido';
  }


  if (empty($errores)) {

    $consulta = $connection->prepare('select * from usuarios where email =?');
    $consulta->execute([$email]);
    $usuario = $consulta->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($password, $usuario['pass'])) {


      if ($usuario['activo'] == 0) {
        $update = $connection->prepare('UPDATE usuarios set activo=1 where email =?');
        $update->execute([$email]);
      }

      $_SESSION['email'] = $email;

      if (isset($_GET['token'])) {
        $token = $_GET['token'];

        $delete = $connection->prepare('DELETE from auth_tokens where token= ? and id_user=?');


        if ($delete->execute([$token, $usuario['id']])) {

          header('Location: publico.php');
          exit();
        }
      }
    } else {
      echo 'error';
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    .login-container {
      width: 300px;
      padding: 16px;
      background-color: #f1f1f1;
      margin: 0 auto;
      margin-top: 100px;
      border-radius: 4px;
    }

    input[type=email],
    input[type=password] {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }

    button {
      background-color: #4CAF50;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      cursor: pointer;
      width: 100%;
    }

    button:hover {
      opacity: 0.8;
    }
  </style>
</head>

<body>


  <div class="login-container">
    <form action="" method="post">
      <label for="email"><b>email de usuario</b></label>
      <input type="email" placeholder="Introduce tu email" name="email" id="email">
      <p style="color: red;"><?= isset($errores['email']) ? $errores['email'] : '' ?></p>


      <label for="password"><b>Contraseña</b></label>
      <input type="password" placeholder="Introduce tu contraseña" name="password" id="password">
      <!-- <p style="color: red;"><?= isset($errores['password']) ? $errores['password'] : '' ?></p> -->



      <button type="submit" name="login">Login</button>
      <!-- <p style="color: red;"><?= isset($errores['credenciales']) ? $errores['credenciales'] : '' ?></p> -->

    </form>
  </div>
</body>

</html>
