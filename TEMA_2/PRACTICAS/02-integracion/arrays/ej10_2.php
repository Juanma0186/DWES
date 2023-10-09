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
  header("Location: ej10_2.php");
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
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

    .fa-star {
      color: #ccc;
    }

    .fa-star:hover {
      color: #f8ce0b;
    }

    .fa-star.active {
      color: #f8ce0b;
    }

    .container {
      width: 100%;
      display: flex;
      flex-direction: column;
      align-items: center;
      margin: 20px;
    }

    .formulario {
      display: flex;
      flex-direction: row;
      align-items: center;
      gap: 10px;
    }

    .formulario label {
      font-weight: bold;
    }

    .formulario input[type="text"],
    .formulario input[type="hidden"],
    .formulario button {
      margin-right: 10px;
    }

    .stars {
      display: flex;
      align-items: center;
    }

    .stars i {
      margin-right: 5px;
      cursor: pointer;
    }

    #valor {
      font-weight: bold;
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
    <div class="formulario">
      <form action="ej10_2.php" method="post">
        <label for="titulo">Título</label>
        <input type="text" name="titulo" id="titulo" required>
        <div class="stars">
          <label for="valoracion">Valoración:</label>
          <i class="fas fa-star" onclick="cambiarValor(1)"></i>
          <i class="fas fa-star" onclick="cambiarValor(2)"></i>
          <i class="fas fa-star" onclick="cambiarValor(3)"></i>
          <p id="valor"></p>
        </div>
        <input type="hidden" name="valoracion" id="valoracion" min=0 max="2">
        <button type="submit">Guardar</button>
      </form>
    </div>
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


  <script>
    function cambiarValor(value) {
      document.getElementById("valoracion").value = value;

      let stars = document.querySelectorAll(".stars i");
      stars.forEach((star, index) => {
        if (index < value) {
          star.classList.add("active");
        } else {
          star.classList.remove("active");
        }
      });

      //añade que depende de la estrella seleccionada se muestre un mensaje u otro
      let valor = document.getElementById("valor");

      switch (value) {
        case 1:
          valor.innerHTML = "Mala";
          break;
        case 2:
          valor.innerHTML = "Buena";
          break;
        case 3:
          valor.innerHTML = "Muy Buena";
          break;
      }

    }
  </script>

</body>

</html>