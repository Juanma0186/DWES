<?php
include 'Database.php';

$db = Database::getInstance();
$connection = $db->getConnection();

// Cogemos el navegador
$navegador = $_SERVER['HTTP_USER_AGENT'];
//Cogemos el timestap
$timestamp = $_SERVER['REQUEST_TIME'];

try {

  $insert = $connection->prepare("INSERT INTO logs(navegador, timestamp) VALUES (?, ?)");
  if ($navegador && $timestamp) {
    $insert->execute([$navegador, $timestamp]);
  }
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hola Mundo</title>
</head>

<body>
  Hola Mundo
</body>

</html>
