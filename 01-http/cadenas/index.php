<?php
// Variables
$vocales = 0;
$consonantes = 0;
$esPalindromo = "";
$arrayVocales = array('a', 'e', 'i', 'o', 'u');
$frase = (isset($_POST['frase'])) ? strtolower($_POST['frase']) : "";

// Función para contar vocales y consonantes
function contar($frase): void
{
    global $vocales, $consonantes, $arrayVocales;

    for ($i = 0; $i < strlen($frase); $i++) {
        if (in_array($frase[$i], $arrayVocales)) {
            $vocales++;
        } else {
            $consonantes++;
        }
    }
}

//Función para saber si es palindromo 
function palindromo($frase): string
{
    $frase = str_replace(' ', '', $frase);
    $length = strlen($frase);

    for ($i = 0; $i < $length / 2; $i++) {
        if ($frase[$i] !== $frase[$length - $i - 1]) {
            return "no";
        }
    }

    return "si";
}

if (isset($_POST['submit'])) {
    contar($frase);
    $esPalindromo = palindromo($frase);
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio Cadenas</title>
    <style>

    </style>
</head>

<body>
    <form action="" method="post">
        <label>Introduce una frase</label>
        <input type="text" name="frase" value="<?= $frase ?>">
        <button type="submit" name="submit"">Analiza</button>
</form>

<div id=" resultado" class="resultado" style="display:none;">
            <p>El número total de vocales es: <?= $vocales ?></p>
            <p>El número total de consonantes es: <?= $consonantes ?></p>
            <p>Es palíndromo: <?= $esPalindromo ?></p>
            </div>

            <script>
            </script>
</body>

</html>