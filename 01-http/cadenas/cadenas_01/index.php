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
        if ($frase[$i] != $frase[$length - $i - 1]) {
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
        body {
            display: grid;
            place-items: center;
            height: 100vh;
            background: lightgreen;
            font-family: 'Roboto', sans-serif;

        }

        .container {
            width: 400px;
            background: whitesmoke;
            border: 2px solid black;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
        }

        .resultado {
            margin: 0 auto;
            width: fit-content;
            text-align: left;
        }

        input[type=text] {
            margin-top: 0.5rem;
            width: 100%;
            padding: 5px;
            border: 1px solid black;
            border-radius: 5px;
            font-family: 'Roboto', sans-serif;
        }

        hr {
            width: 75%;
            height: 2px;
            background: lightgreen;
            border: none;
        }

        button {
            margin-top: 0.5rem;
            background: lightgreen;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            cursor: pointer;
        }

        button:hover {
            background: green;
            color: white;
        }

        .dato {
            font-weight: bold;
            text-transform: uppercase;
            color: green;
        }
    </style>
</head>

<body>
    <div class="container">
        <form action="" method="post">
            <label>Introduce una frase</label>
            <br>
            <input type="text" name="frase" value="<?= $frase ?>">
            <br>
            <button type="submit" name="submit"">Analiza</button>
        </form>
    <hr>
    <div class=" resultado">
                <p>El número total de vocales es: <span class="dato"> <?= $vocales ?></span></p>
                <p>El número total de consonantes es: <span class="dato"><?= $consonantes ?></span></p>
                <p>Es palíndromo: <span class="dato"><?= $esPalindromo ?></span></p>
    </div>
    </div>
</body>

</html>