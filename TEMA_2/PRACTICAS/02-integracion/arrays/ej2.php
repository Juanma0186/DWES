<?php

$alumnos = [
  ["nombre" => "Juan", "edad" => 20, "curso" => "Matemáticas"],
  ["nombre" => "Ana", "edad" => 19, "curso" => "Historia"],
  ["nombre" => "Carlos", "edad" => 21, "curso" => "Inglés"],
  ["nombre" => "María", "edad" => 17, "curso" => "Lengua"],
];

$alumnoJoven = $alumnos[0];

function encontrarJoven(array $alumnos)
{
  global $alumnoJoven;
  $i = 0;
  while ($i < count($alumnos)) {
    if ($alumnoJoven == null || $alumnos[$i]["edad"] < $alumnoJoven["edad"]) {
      $alumnoJoven = $alumnos[$i];
    }
    $i++;
  }
  return $alumnoJoven;
}

function alumnoJovenReduce(array $alumnos)
{
  $alumnoJovenReduce =  array_reduce($alumnos, function ($anterior, $posterior) {
    if ($posterior["edad"] < $anterior["edad"]) {
      return $posterior;
    }
    return $anterior;
  }, $alumnos[0]);

  return $alumnoJovenReduce;
}

function compararEdad($alumno)
{
  global $alumnoJoven;
  if ($alumno["edad"] < $alumnoJoven["edad"]) {
    $alumnoJoven = $alumno;
  }
}

function ordenar($a, $b)
{
  return $a["edad"] - $b["edad"];
}

function imprimirFila($alumno)
{
  echo "<tr>";
  echo "<td>$alumno[nombre]</td>";
  echo "<td>$alumno[edad]</td>";
  echo "</tr>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Arrays 2</title>
  <style>
    table,
    tr,
    td,
    th {
      text-align: center;
      border: #000 2px solid;
      padding: 10px;
    }
  </style>

</head>

<body>
  <h1>While</h1>
  <p><?php

      printf("El alumno más joven es %s y tiene %d años", encontrarJoven($alumnos)["nombre"], encontrarJoven($alumnos)["edad"]);

      ?></p>
  <hr>
  <h1>Array_Map</h1>
  <p><?php
      array_map("compararEdad", $alumnos);
      echo "El alumno más joven es " . $alumnoJoven["nombre"] . " y tiene " . $alumnoJoven["edad"] . " años.";
      ?></p>
  <hr>
  <h1>Tabla de Alumnos</h1>
  <p>
  <table>
    <tr>
      <th>Nombre</th>
      <th>Edad</th>
    </tr><?php
          usort($alumnos, 'ordenar');
          array_map("imprimirFila", $alumnos);
          ?>
  </table>
  <p>
    <?php printf("El alumno más joven es %s y tiene %d años", alumnoJovenReduce($alumnos)["nombre"], alumnoJovenReduce($alumnos)["edad"]); ?>
  </p>
</body>

</html>