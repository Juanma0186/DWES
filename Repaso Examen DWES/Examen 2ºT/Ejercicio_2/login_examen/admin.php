<?php
session_start();

if (!isset($_SESSION['username'])) {
  $_SESSION['url'] = $_SERVER['REQUEST_URI'];
  header('Location: login.php?login=logueate');
  exit();
}
?>

<html>

<head>
  <link rel="stylesheet" type="text/css" media="all" href="css/estilo.css">
</head>

<body>
  <h1>Bienvenido!!</h1>
  <?php include('menu.php') ?>
  <p>Información solo para admin</p>
</body>

</html>
