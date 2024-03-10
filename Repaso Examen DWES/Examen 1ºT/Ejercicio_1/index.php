<?php
function pintarCabecera(...$titulos)
{
  $html = '<thead><tr>';
  foreach ($titulos as $columna) {
    $html .= "<th>$columna</th>";
  }
  $html .= '</tr></thead>';
  return $html;
}

function pintaContenido(...$datos)
{
  $html = '';
  foreach ($datos as $dato) {
    $html .= "<td>$dato</td>";
  }
  return $html;
}

function pintaHorarioVacio()
{
  $horas = ["9:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00", "17:00", "18:00", "19:00", "20:00", "21:00", "22:00"];
  $diasSemana = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'];

  $html = '<table>';

  // Imprimir la cabecera
  $html .= pintarCabecera('Horas', ...$diasSemana);

  $html .= '<tr>';
  // Usamos array_walk para recorrer el array de horas y pintar una fila por cada hora
  array_walk($horas, function ($hora) use (&$html, $diasSemana) {
    $html .= "<tr><td>$hora</td>";
    // Usamos array_map para recorrer el array de días y pintar una celda vacía por cada día
    array_map(function ($dia) use (&$html) {
      $html .= '<td></td>';
    }, $diasSemana);
    $html .= '</tr>';
  });
  $html .= '</table>';
  return $html;
}

function pintarHorizontal($array)
{
  if (empty($array)) {
    return '';
  }

  $html = '<table>';

  // Imprimir la cabecera
  $html .= '<thead><tr>';
  foreach ($array as $clave => $valor) {
    $html .= "<td>$clave</td>";
  }
  $html .= '</tr></thead>';

  // Imprimir el contenido
  $html .= '<tbody><tr>';
  foreach ($array as $clave => $valor) {
    $html .= "<td>$valor</td>";
  }
  $html .= '</tr></tbody></table>';
  return $html;
}

function pintarVertical($array)
{
  if (empty($array)) {
    return '';
  }

  $html = '<table>';
  foreach ($array as $clave => $valor) {
    $html .= "<tr><td>$clave</td><td>$valor</td></tr>";
  }
  $html .= '</table>';
  return $html;
}

$arrayAsociativo = array(
  'Nombre' => 'Juan',
  'Edad' => 22,
  'Ciudad' => 'León',
  'País' => 'España'
);

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ejericio 1</title>
</head>

<body>
  <h2>Horario</h2>
  <?= pintaHorarioVacio(); ?>
  <hr>

  <h2>Pintar Horizontal</h2>
  <?= pintarHorizontal($arrayAsociativo); ?>
  <hr>

  <h2>Pintar Vertical</h2>
  <?= pintarVertical($arrayAsociativo); ?>
</body>

</html>
