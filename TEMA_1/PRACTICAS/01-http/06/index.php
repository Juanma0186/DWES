<?php
  // Definimos las variables
  $nombre = "Juanma";
  $radio = (isset($_POST['radio']))?$_POST['radio'] : ""; 
        
  // Calculamos el perímetro, el área y el diámetro
  if(isset($_POST['radio'])){
    $perimetro = 2 * pi() * $radio;
    $area = pi() * pow($radio, 2);
    $diametro = 2 * $radio;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Área y Perímetro</title>
  <style>
    body{
      font-family: 'Roboto', sans-serif;
    }
    .info{
      display:grid;
      grid-template-columns: repeat(2, 1fr);
      position: fixed;
      bottom:0;
      left:0;
      width:30%;
      height:fit-content;
      padding:1em;
      border-top: #8870ff 2px solid;
      border-right: #8870ff 2px solid;
      border-radius: 0px 10px 0 0;
      background-color: rgba(0,0,0,0.2);
      text-align:center;
      z-index:99
    }

    .bienvenida{
      font-size:18px;
    }

    .bienvenida h2{
      font-size:1.5em;
      font-weight:bold;
      font-style: italic;
      color:#8870ff;
    }

    input[type=text]{
      margin-top:0.5em;
      width:75%;
      padding:0.5em;
      border-radius:5px;
      border:none;
      border: 1px solid #8870ff;
      margin-bottom:1em;
    }

    .bienvenida button{
      margin-top:0.5em;
      background-color: #8870ff;
      color:white;
      border:none;
      border-radius:5px;
      padding:0.5em;
      font-size:1em;
      font-weight:bold;
      font-style: italic;
      cursor:pointer;
    }

    .resultados{
      font-size:18px;
    }

    .resultados h2{
      font-size:1.5em;
      font-weight:bold;
      font-style: italic;
      color:#8870ff;
    }

    .resultados p{
      font-size:1em;
      font-weight:bold;
    }

    .resultados .dato{
      font-style: italic;
      color:#8870ff;
      text-decoration:underline;
    }

    .container{
      position:absolute;
      top:50%;
      left: 50%;
      transform: translate(-50%, -50%);

      display:grid;
      place-items:center;
      height:100vh;
    }
    .contenido{
      display:grid;
      place-items:center;

    }
    .circulo{
      width:<?=$diametro;?>px;
      height:<?=$diametro;?>px;
      border-radius:50%;
      border: 1px solid #8870ff;
    }

    .contenido p{
      font-size:1.5em;
      font-weight:bold;
      font-style: italic;
      color:#8870ff;
      width:100%;
      text-align:center;
    }
  </style>
</head>
<body>

  <!-- Creamos el div que nos mostrará la información y nos pedirá el tamaño del radio-->
  <div class="info">
    <div class="bienvenida">
    <h2>Bienvenido <?=$nombre;?></h2>
      <form method="POST" action="">
          <label for="radio">Ingresa el radio en px:</label>
          <input type="text" id="radio" name="radio" value="<?=$radio?>" placeholder="Introduce radio">
          <br>
          <button type="submit" name="calcular">Calcular</button>
      </form>
    </div>

    <!-- Mostramos los resultados -->
    <div class="resultados">
      <h2>Resultados:</h2>
      <p>Radio: <span class="dato"><?=number_format(floatval($radio), 2);?> px</span></p>
      <p>Perímetro: <span class="dato"><?=number_format($perimetro,2);?>px</span></p>
      <p>Área: <span class="dato"><?=number_format($area, 2);?>px<sup>2</sup></span</p>
    </div>
  </div>

  <!--Pintamos la circunferencia y su radio debajo-->
  <div class="container">
    <div class="contenido">
      <div class="circulo">
      </div>
      <p>Circunferencia de R=<?=$radio;?>px</p>
      </div>
    </div>
  </div>
</body>
</html>