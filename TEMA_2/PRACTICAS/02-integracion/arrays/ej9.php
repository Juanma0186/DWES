<?php
//Comprobamos que el archivo existe y que no esta vacio
if (file_exists('store.dat') && filesize('store.dat') > 0) {
  $s = file_get_contents('store.dat');
  $tareas = unserialize($s);
} else {
  //Si no existe o esta vacio creamos un array vacio de tareas
  $tareas = [];
}

function añadirTarea($nombre, $fecha, $asignatura, $descripcion)
{
  global $tareas;
  array_push($tareas, ["nombre" => $nombre, "fecha" => $fecha, "asignatura" => $asignatura, "descripcion" => $descripcion]);

  //Guardamos el array en el archivo
  $s = serialize($tareas);
  file_put_contents('store.dat', $s);
}

if (isset($_POST['añadir'])) {
  $nombre = $_POST['nombre'];
  $fecha = $_POST['fecha'];
  $asignatura = $_POST['asignatura'];
  $descripcion = $_POST['descripcion'];

  añadirTarea($nombre, $fecha, $asignatura, $descripcion);

  //Redirigimos a la misma pagina para que no se envie el formulario al recargar y se repita la misma tarea varias veces
  header("Location: ej9.php");
  exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Arrays 9</title>
  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
      height: 100vh;
      display: grid;
      place-items: center;
    }

    .annadir {
      position: absolute;
      top: 50%;
      left: 0;
      margin-left: 2em;
      transform: translateY(-50%);
    }

    table,
    tr,
    td,
    th {
      text-align: center;
      border: #000 2px solid;
      padding: 15px;
    }

    caption {
      font-size: 30px;
      font-weight: bold;
      font-style: italic;
      font-family: 'Courier New', Courier, monospace;
    }

    thead {
      font-size: 20px;
      font-weight: bold;
      font-style: italic;
    }
  </style>
</head>

<body>
  <table>
    <caption>TODO List</caption>
    <thead>
      <tr>
        <td>Nombre</td>
        <td>Fecha</td>
        <td>Asignatura</td>
        <td>Descripción</td>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($tareas as $tarea) {
        echo "<tr>";
        echo "<td>$tarea[nombre]</td>";
        echo "<td>$tarea[fecha]</td>";
        echo "<td>$tarea[asignatura]</td>";
        echo "<td>$tarea[descripcion]</td>";
        echo "</tr>";
      }
      ?>
    </tbody>
  </table>

  <div class="annadir">
    <form action="ej9.php" method="post">
      <!--formulario para añadir mas tareas-->
      <fieldset>
        <legend>Añadir tarea</legend>
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" required>
        <br>
        <label for="fecha">Fecha</label>
        <input type="date" name="fecha" id="fecha" required>
        <br>
        <label for="asignatura">Asignatura</label>
        <input type="text" name="asignatura" id="asignatura" required>
        <br>
        <label for="descripcion">Descripción</label>
        <input type="text" name="descripcion" id="descripcion" required>
        <br>
        <input type="submit" value="Añadir tarea" name="añadir">
    </form>
  </div>
</body>

</html>