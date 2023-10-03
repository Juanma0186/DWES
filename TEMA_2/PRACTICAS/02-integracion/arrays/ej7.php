<?php

$frutas = ["Manzana", "Plátano", "Naranja", "Uva"];

function anadirFruta($fruta)
{
  global $frutas;
  array_push($frutas, $fruta);
}

if (isset($_POST['fruta'])) {
  anadirFruta($_POST['fruta']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Arrays 7</title>
</head>

<body>
  <table>
    <thead>
      <tr>
        <td>Nombre</td>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($frutas as $fruta) {
        echo "<tr>";
        echo "<td>$fruta</td>";
        echo "</tr>";
      }
      ?>
  </table>
  <form action="ej7.php" method="post">
    <label for="fruta">Nombre de la fruta</label>
    <input type="text" name="fruta" id="fruta">
    <input type="submit" value="Añadir">
  </form>
</body>

</html>