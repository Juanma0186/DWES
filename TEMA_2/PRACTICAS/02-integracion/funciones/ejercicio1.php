<!-- magia('li',"Hola Mundo", 3, 3.14)

<li>Hola Mundo</li>
<li>3</li>
<li>3.14</li> 

magia('li',"Esto solo")
-->

<?php
function magia(string $tag = "li", mixed ...$contenido): void
{

  for ($i = 0; $i < count($contenido); $i++) {

    echo "<$tag>$contenido[$i]</$tag>";
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Funciones 1</title>
</head>

<body>
  <div class="container">
    <?= magia("li", "Hola Mundo", 3, 3.14) ?>
  </div>
</body>

</html>