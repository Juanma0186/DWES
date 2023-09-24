<?php
  $cols =3;
  $tono = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pantone</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    .container {
      display: grid;
      grid-template-columns: repeat(calc(<?=$cols?> + 1), 1fr);
      height: 100vh;
    }

    .tono {
      flex: 1;
      display: grid;
      place-items: center;
      color: white;
      height: 100vh;
      transition: all 1s ease-in-out;
    }

    .tono span {
      font-family: 'Roboto', sans-serif;
      font-size: 1em;
      font-style: italic;
      font-weight: bold;
      text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.5);
      writing-mode: vertical-rl;
      text-orientation: upright;
    }

    .tono:hover{
      width: 20vw;
      transition: all 1s ease-in-out;
    }

    .tono:hover span{
      writing-mode: horizontal-tb;
    }
  </style>
</head>
<body>
  <div class="container">
    <?php
      $step = 255 / ($cols);

      for ($i = 0; $i <= 255; $i += $step) {

          printf("<div class='tono' style='background-color:#00%02X00'><span>#00%02X00</span></div>\n\t", $tono, $tono);
          
          $tono += $step;
          
          if($tono > 255) {
            $tono = 255;
          }

          

       }
    ?>
  </div>
</body>
</html>
