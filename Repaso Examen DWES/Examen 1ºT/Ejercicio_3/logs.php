<?php

require_once 'data.php';

try {
  // Hacemos la conexión
  $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Capturar errores

  $consulta = $db->prepare('SELECT * FROM logs');
  $consulta->execute();
  $logs = $consulta->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Logs | Hola Mundo</title>
</head>

<body>
  <h1>Logs</h1>
  <?php if (empty($logs)) : ?>
    <tr>
      <td colspan="3">No hay logs</td>
    </tr>
  <?php else : ?>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Navegador</th>
          <th>Timestamp</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($logs as $log) : ?>
          <tr>
            <td><?= $log['id'] ?></td>
            <td><?= $log['navegador'] ?></td>
            <td><?= $log['timestamp'] ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</body>

</html>
