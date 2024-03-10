<?php
include 'Database.php';

$db = Database::getInstance();
$connection = $db->getConnection();

try {
  $consulta = $connection->prepare("SELECT * FROM logs");
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
  <title>Document</title>
</head>

<body>
  <h1>LOGS DEL HOLA MUNDO</h1>

  <?php if (empty($logs)) { ?>
    <p>No hay logs</p>
  <?php } else { ?>
    <table>

      <thead>
        <tr>
          <td>
            ID
          </td>
          <td>
            NAVEGADOR
          </td>
          <td>
            TIMESTAMP
          </td>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($logs as $log) { ?>
          <tr>
            <td><?= $log['id'] ?></td>
            <td><?= $log['navegador'] ?></td>
            <td><?= date("d-m-Y H:i", $log['timestamp']) ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  <?php } ?>
</body>

</html>
