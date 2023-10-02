<?php

$frutas = ["Manzana", "Plátano", "Naranja", "Uva"];
$precios = [1.2, 0.8, 1.0, 2.5];
$cantidadKg = [1.25, 3.2, 5.1, 1.45];


$total = array_sum($precios);

function imprimirFila($fruta, $precio)
{
  echo "<tr>";
  echo "<td>$fruta</td>";
  echo "<td>$precio €</td>";
  echo "</tr>";
}

function calcularPrecioTotalPorKg($frutas, $precios, $cantidadKg)
{
  $total = 0;
  for ($i = 0; $i < count($frutas); $i++) {
    $total += $precios[$i] * $cantidadKg[$i];
  }
  return $total;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Arrays 4</title>
</head>

<body>

  <p>
    <?php print_r("La suma total de todas las frutas es: " . number_format($total, 2) . "€");
    ?>
  </p>
  <hr>
  <p>
    <?php
    print_r("La suma total de todas las frutas multiplicada por sus respectivos KG es: " . number_format(calcularPrecioTotalPorKg($frutas, $precios, $cantidadKg), 2) . "€");
    ?>
  </p>

</body>

</html>