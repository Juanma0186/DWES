<?php

$frutas = ["Manzana", "Plátano", "Naranja", "Uva"];
$precios = [1.2, 0.8, 1.0, 2.5];

function imprimirFila($fruta, $precio)
{
  echo "<tr>";
  echo "<td>$fruta</td>";
  echo "<td>$precio €</td>";
  echo "</tr>";
}

function sLista(array $info, string $tipo = 'ol'): string //Los valores por defecto siempre deberán ir al final de los parámetros de la función
{
  $html = "<$tipo>";

  foreach ($info as $i) {
    $html .= "<li>$i</li>";
  }

  $html .= "</$tipo>";
  return $html;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Arrays 1</title>
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
  <div class="contenido">
    <ol>
      <?php
      foreach ($frutas as $fruta) {
        echo "<li>$fruta</li>";
      }
      ?>
    </ol>
    <hr>
    <table>
      <tr>
        <th>Fruta</th>
        <th>Precio</th>
      </tr>
      <?php
      for ($i = 0; $i < count($frutas); $i++) {
        echo "<tr>";
        echo "<td>$frutas[$i]</td>";
        echo "<td>$precios[$i]€</td>";
        echo "</tr>";
      }
      ?>
    </table>
    <hr>

    <table>
      <tr>
        <th>Fruta</th>
        <th>Precio</th>
      </tr>
      <?php
      array_map("imprimirFila", $frutas, $precios);
      ?>
    </table>
  </div>
</body>

</html>