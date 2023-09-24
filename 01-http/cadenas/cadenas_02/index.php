<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Carta de presentación</title>

</head>

<body>
  <div class="container">
    <h1>FORMULARIO</h1>
    <form action="empresa.php" method="post">
      <label for="nombre">Introduce tu nombre completo</label>
      <input type="text" name="nombre" id="nombre" required>
      <label for="empresa">Introduce el nombre de la empresa</label>
      <input type="text" name="empresa" id="empresa" required>
      <label>Fecha</label>
      <input type="date" name="fecha" id="fecha" required>
      <button type="submit">Enviar</button>
    </form>
  </div>
</body>

</html>