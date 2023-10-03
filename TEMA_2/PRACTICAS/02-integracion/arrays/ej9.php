<?php
define("FILE_NAME", "store.dat");
//Comprobamos que el archivo existe y que no esta vacio
if (file_exists(FILE_NAME) && filesize(FILE_NAME) > 0) {
  $s = file_get_contents(FILE_NAME);
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
  file_put_contents(FILE_NAME, $s);
}

function eliminarTareasSeleccionadas($tareas, $seleccionadas)
{
  $nuevasTareas = [];
  foreach ($tareas as $indice => $tarea) {
    if (!in_array($indice, $seleccionadas)) {
      $nuevasTareas[] = $tarea;
    }
  }
  return $nuevasTareas;
}

if (isset($_POST['eliminar'])) {

  $seleccionadas = isset($_POST['seleccionadas']) ? $_POST['seleccionadas'] : [];
  $tareas = eliminarTareasSeleccionadas($tareas, $seleccionadas);

  // Guardar el nuevo array de tareas en el archivo
  $s = serialize($tareas);
  file_put_contents(FILE_NAME, $s);

  // Redirigir a la misma página para mostrar las tareas actualizadas
  header("Location: ej9.php");
  exit;
}

if (isset($_POST['nombre'])) {
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

    .container {
      display: grid;
      place-items: center;
    }

    .delete {
      margin-top: 1em;
      padding: 10px;
      border: 3px solid #000;
      text-align: center;
      background-color: #fff;
      font-size: 20px;
      font-weight: bold;
    }

    .delete:hover {
      border-color: red;
      color: red;
    }
  </style>
</head>

<body>

  <form action="ej9.php" method="post">
    <table>
      <caption>TODO List</caption>
      <thead>
        <tr>
          <td>Eliminar</td>
          <td>Nombre</td>
          <td>Fecha</td>
          <td>Asignatura</td>
          <td>Descripción</td>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($tareas as $indice => $tarea) {
          echo "<tr>";
          echo "<td><input type='checkbox' name='seleccionadas[]' value='$indice'></td>";
          echo "<td>$tarea[nombre]</td>";
          echo "<td>$tarea[fecha]</td>";
          echo "<td>$tarea[asignatura]</td>";
          echo "<td>$tarea[descripcion]</td>";
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>
    <div class="container">
      <button class="delete" type="submit" name="eliminar">Eliminar</button>
    </div>
  </form>
  </div>

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
      </fieldset>
    </form>
  </div>
</body>

</html>