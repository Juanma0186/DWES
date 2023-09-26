<?php

include('data9.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Eventos</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    .container {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      height: 100vh;
    }

    .evento1 {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      width: 100%;
      height: 100%;
      background-color: lightcoral;
    }

    .evento2 {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      width: 100%;
      height: 100%;
      background-color: lightblue;
    }

    hr {
      width: 50%;
      border: none;
      height: 2px;

    }

    hr.uno {
      background: lightblue;
    }

    hr.dos {
      background: lightcoral;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="evento1">
      <h1>Mostrar Evento</h1>
      <?php mostrarEvento($evento1) ?>
      <hr class="uno">

    </div>
    <div class="evento2">
      <h1>Mostrar Evento</h1>
      <?php mostrarEvento($evento2) ?>
      <hr class="dos">
    </div>
  </div>
</body>

</html>