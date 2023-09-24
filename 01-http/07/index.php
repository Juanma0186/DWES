<!DOCTYPE html>
<html>
<head>
    <title>Calculatrón</title>
</head>
<body>
    <?php
    // Declaración de dos variables
    $numero1 = 10;
    $numero2 = 5;

    // Suma
    $suma = $numero1 + $numero2;

    // Resta
    $resta = $numero1 - $numero2;

    // Multiplicación
    $multiplicacion = $numero1 * $numero2;

    // División
    $division = $numero1 / $numero2;

    // Resto (Módulo)
    $resto = $numero1 % $numero2;

    // Incremento (++): Aumenta en 1 el valor de la variable
    $numero1++;

    // Decremento (--): Disminuye en 1 el valor de la variable
    $numero2--;

    // Mostrar los resultados
    echo "<p>Suma: " . $suma . "</p>";
    echo "<p>Resta: " . $resta . "</p>";
    echo "<p>Multiplicación: " . $multiplicacion . "</p>";
    echo "<p>División: " . $division . "</p>";
    echo "<p>Resto: " . $resto . "</p>";
    echo "<p>Incremento de numero1: " . $numero1 . "</p>";
    echo "<p>Decremento de numero2: " . $numero2 . "</p>";

    // Obtener y mostrar las variables definidas
    $variables_definidas = get_defined_vars();
    echo "<p>Variables definidas:</p>";
    echo "<pre>";
    print_r($variables_definidas);
    echo "</pre>";
    ?>
</body>
</html>
