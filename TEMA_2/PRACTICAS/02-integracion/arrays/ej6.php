<?php

$biblioteca = [
  "desc" => "Biblioteca Pública Municipal",
  "localizacion" => "Calle Mayor, 1",
  "horario" => [
    "Lunes" => "10:00 - 14:00",
    "Martes" => "10:00 - 14:00",
    "Miércoles" => "10:00 - 14:00",
    "Jueves" => "10:00 - 14:00",
    "Viernes" => "10:00 - 14:00",
    "Sábado" => "Cerrado",
    "Domingo" => "Cerrado"
  ],
  "libros" => [
    [
      "titulo" => "El Quijote",
      "autor" => "Cervantes",
      "ejemplares" => 3
    ],
    [
      "titulo" => "El hobbit",
      "autor" => "Tolkien",
      "ejemplares" => 5
    ],
    [
      "titulo" => "1984",
      "autor" => "Orwell",
      "ejemplares" => 2
    ],
    [
      "titulo" => "El código Da Vinci",
      "autor" => "Brown",
      "ejemplares" => 6
    ],
    [
      "titulo" => "Los pilares de la Tierra",
      "autor" => "Follet",
      "ejemplares" => 1
    ],
    [
      "titulo" => "El alquimista",
      "autor" => "Coelho",
      "ejemplares" => 4
    ],
    [
      "titulo" => "La sombra del viento",
      "autor" => "Ruiz Zafón",
      "ejemplares" => 3
    ],
    [
      "titulo" => "El nombre del viento",
      "autor" => "Rothfuss",
      "ejemplares" => 2
    ],
    [
      "titulo" => "El psicoanalista",
      "autor" => "Katzenbach",
      "ejemplares" => 1
    ],
    [
      "titulo" => "El último deseo",
      "autor" => "Sapkowski",
      "ejemplares" => 2
    ]
  ]
];

$libros = $biblioteca['libros'];
$msg = "";
$nombreLibro = "";

if (isset($_POST['buscar'])) {
  $nombreLibro = trim($_POST['nombreLibro']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Arrays 5</title>
  <style>
    table,
    tr,
    td,
    th {
      text-align: center;
      border: #000 2px solid;
      padding: 10px;
    }

    .seleccionado {
      background-color: yellow;
      font-weight: bold;

    }
  </style>

</head>

<body>
  <h1><?= $biblioteca['desc'] ?></h1>
  <h2><?= $biblioteca['localizacion'] ?></h2>
  <h3>Horario</h3>
  <table>
    <tr>
      <?php
      foreach ($biblioteca['horario'] as $dia => $horas) {
        echo "<td>$dia</td>";
      }
      ?>
    </tr>
    <tr>
      <?php
      foreach ($biblioteca['horario'] as $dia => $horas) {
        echo "<td>$horas</td>";
      }
      ?>
    </tr>
  </table>
  <hr>
  <form method="post">
    <label for="nombreLibro">Buscar libro:</label>
    <input type="text" id="nombreLibro" name="nombreLibro">
    <input type="submit" name="buscar" value="Buscar">
  </form>
  <hr>
  <table>
    <tr>
      <th>Libro</th>
      <th>Autor</th>
      <th>Ejemplares</th>
    </tr>
    <?php
    foreach ($libros as $libro) {
      if ($libro["titulo"] == $nombreLibro) {
        echo "<tr class='seleccionado'><td>$libro[titulo]</td><td>$libro[autor]</td><td>$libro[ejemplares]</td></tr>";
      } else {
        echo "<tr><td>$libro[titulo]</td><td>$libro[autor]</td><td>$libro[ejemplares]</td></tr>";
      }
    }

    ?>
  </table>
</body>

</html>