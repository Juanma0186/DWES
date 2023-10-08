<?php

define("FILE_NAME", "peliculas.json");
//Comprobamos que el archivo existe y que no esta vacio
if (file_exists(FILE_NAME) && filesize(FILE_NAME) > 0) {
  $s = file_get_contents(FILE_NAME);
  $peliculas = json_decode($s, true);
  $vistas = [];
  $pendientes = [];
  foreach ($peliculas as $pelicula) {
    if ($pelicula['valoracion'] != null) {
      $vistas[] = $pelicula;
    } else {
      $pendientes[] = $pelicula;
    }
  }
  //Ordenamos los arrays
  ordenarValoracion($vistas);
  ordenarNombre($pendientes);
} else {
  //Si no existe o esta vacio creamos un array vacio de peliculas
  $peliculas = [];
}
function guardar($peliculas)
{
  $s = json_encode($peliculas);
  file_put_contents(FILE_NAME, $s);
}

function annadirPeli($titulo, $peliculas, $valoracion = null)
{
  array_push($peliculas, ["titulo" => $titulo, "valoracion" => $valoracion]);
  guardar($peliculas);
}

if (isset($_POST['titulo'])) {
  $titulo = $_POST['titulo'];
  $valoracion = $_POST['valoracion'];

  if ($valoracion == null) {
    annadirPeli($titulo, $peliculas);
  } else {
    annadirPeli($titulo, $peliculas, $valoracion);
  }



  //Redirigimos a la misma pagina para que no se envie el formulario al recargar y se repita la misma tarea varias veces
  header("Location: ej10.php");
  exit;
}
function ordenarValoracion(&$vistas)
{
  usort($vistas, function ($a, $b) {
    return $b['valoracion'] <=> $a['valoracion'];
  });
  return $vistas;
}

function ordenarNombre(&$pendientes)
{
  usort($pendientes, function ($a, $b) {
    return $a['titulo'] <=> $b['titulo'];
  });
  return $pendientes;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Peliculas</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Roboto', sans-serif;
      display: flex;
      flex-direction: column;
      align-items: center;
      min-height: 100vh;

    }

    .container {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin: 20px;
    }

    .container h1 {
      margin-bottom: 20px;
      font-size: 1.5em;
      font-weight: bold;
      font-style: italic;
    }

    .pelis {
      margin-top: 3em;
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      grid-gap: 20px;
      height: 100%;
      width: 100%;
    }

    .vistas,
    .pendientes {
      padding: 2em;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    h2 {
      margin-bottom: 1em;
    }

    table,
    tr,
    td,
    th {
      text-align: center;
      border: #000 2px solid;
      padding: 15px;
    }
  </style>
</head>

<body>
  <div class="container">
    <h1>Introduce una película</h1>
    <form action="ej10.php" method="post">
      <label for="titulo">Título</label>
      <input type="text" name="titulo" id="titulo" required>
      <label for="valoracion">Valoración</label>
      <input type="number" name="valoracion" id="valoracion" min=0 max="10">
      <button type="submit">Guardar</button>
    </form>
  </div>
  <div class="pelis">
    <div class="vistas">
      <h2>Películas vistas</h2>
      <?php if (!empty($vistas)) : ?>
        <table>
          <thead>
            <tr>
              <th>Título</th>
              <th>Valoración</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($vistas as $pelicula) : ?>
              <tr>
                <td><?= $pelicula['titulo'] ?></td>
                <td><?= $pelicula['valoracion'] ?></td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      <?php else : ?>
        <p>No hay películas vistas.</p>
      <?php endif ?>
    </div>
    <div class="pendientes">
      <h2>Películas pendientes</h2>
      <?php if (!empty($pendientes)) : ?>
        <table>
          <thead>
            <tr>
              <th>Título</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($pendientes as $pelicula) : ?>
              <tr>
                <td><?= $pelicula['titulo'] ?></td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      <?php else : ?>
        <p>No hay películas pendientes.</p>
      <?php endif ?>
    </div>
  </div>
</body>

</html>