<?php

$eventos = [
  ["Evento 1", "2023-09-30"],
  ["Evento 2", "2023-10-02"],
  ["Evento 3", "2023-10-10"],
  ["Evento 4", "2022-11-10"],
  ["Evento 5", "2024-02-10"]
];

$hoy = date('Y-m-d');

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Arrays 3</title>
  <style>
    table,
    tr,
    td,
    th {
      text-align: center;
      border: #000 2px solid;
      padding: 10px;
    }

    thead {
      font-size: 20px;
      font-weight: bold;
      font-style: italic;
    }

    .anterior {
      font-style: italic;
      color: red;
    }

    .futuro {
      font-weight: bold;
      color: green;
    }

    .hoy {
      text-decoration: underline wavy;
    }
  </style>
</head>

<body>
  <table>
    <thead>
      <tr>
        <td>Nombre</td>
        <td>Fecha</td>
      </tr>
    </thead>
    <tbody>
      <?php

      foreach ($eventos as $evento) {
        $fecha = $evento[1];

        if ($fecha > $hoy) {

          echo "<tr class='futuro'><td>$evento[0]</td><td>$fecha</td></tr>";
        } else if ($fecha < $hoy) {

          echo "<tr class='anterior'><td>$evento[0]</td><td>$fecha</td></tr>";
        } else {

          echo "<tr class='hoy'><td>$evento[0]</td><td>$fecha</td></tr>";
        }
      }

      ?>
    </tbody>
  </table>

</body>

</html>