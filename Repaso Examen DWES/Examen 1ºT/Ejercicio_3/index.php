<?php

require_once 'data.php';

// Cogemos el navegador
$navegador = $_SERVER['HTTP_USER_AGENT'];
//Cogemos el timestap
$timestamp = $_SERVER['REQUEST_TIME'];

try {
  $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $insert = $db->prepare('INSERT INTO logs (navegador, timestamp) VALUES (?,?)');
  if ($navegador && $timestamp) {
    $insert->execute([$navegador, $timestamp]);
  }
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hola Mundo</title>
</head>

<body>
  <h1>Hola Mundo</h1>
</body>

</html>
