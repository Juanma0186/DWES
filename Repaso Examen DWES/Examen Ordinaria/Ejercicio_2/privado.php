<?php
session_start();
if (!isset($_SESSION['email'])) {
  header('Location: login.php');
  exit();
}

$email = $_SESSION['email'];

?>

<html>

<head>
  <link rel="stylesheet" type="text/css" media="all" href="css/estilo.css">
</head>

<body>
  <h1>Bienvenido <?= $email ?>!!</h1>
  <?php include('menu.php') ?>
  <p>Información solo para gente autentificada</p>
  <a href="logout.php">Salir</a>
</body>

</html>
