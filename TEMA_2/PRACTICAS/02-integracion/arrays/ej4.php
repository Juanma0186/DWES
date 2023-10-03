<?php

$frutas = ["Manzana", "Plátano", "Naranja", "Uva"];
$precios = [1.2, 0.8, 1.0, 2.5];
$cantidades = [1.25, 3.2, 5.1, 1.45];

$total = array_sum(array_map(function ($precio, $cantidad) {
  return $precio * $cantidad;
}, $precios, $cantidades));

function imprimirFila($fruta, $cantidad, $precioUnitario, $precioTotal)
{
  echo "<tr>";
  echo "<td>$fruta</td>";
  echo "<td>$cantidad kg</td>";
  echo "<td>$precioUnitario €/kg</td>";
  echo "<td>$precioTotal €</td>";
  echo "</tr>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Arrays 4 y 5</title>
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
  </style>
</head>

<body>
  <table border="1">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Cantidad</th>
        <th>Precio Unitario</th>
        <th>Precio Total</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($frutas as $indice => $fruta) {
        $precioTotalProducto = $cantidades[$indice] * $precios[$indice];
        imprimirFila($fruta, $cantidades[$indice], $precios[$indice], $precioTotalProducto);
      }
      ?>
      <tr>
        <td colspan="3">Gasto Total:</td>
        <td><?php echo number_format($total, 2); ?> €</td>
      </tr>
    </tbody>
  </table>
</body>

</html>