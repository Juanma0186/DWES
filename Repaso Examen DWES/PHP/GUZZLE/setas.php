<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;

// Crear un nuevo cliente Guzzle
$client = new Client([
    'base_uri' => 'https://www.fungipedia.org',
    'timeout'  => 2.0,
    'verify' => false
]);

// Hacer una solicitud GET a la página web
$response = $client->request('GET', '/hongos.html');

// Obtener el cuerpo de la respuesta como una cadena de texto
$content = (string) $response->getBody();

// Crear un nuevo documento DOM y cargar el contenido HTML
$doc = new DOMDocument();
libxml_use_internal_errors(true);
$doc->loadHTML($content);
libxml_use_internal_errors(false);

// Crear un nuevo DOMXPath y buscar los elementos
$xpath = new DOMXPath($doc);
$elements = $xpath->query('
//h3[@class="catItemTitle"] |
//span[contains(text(), "Sinónimo: ")]/following-sibling::text() |
//span[contains(text(), "Nombre común: ")]/following-sibling::text()');

// Conectar a la base de datos
$db = new PDO('mysql:host=localhost;dbname=setas', 'setas', 'setas');

// Preparar la consulta SQL
$stmt = $db->prepare('INSERT INTO setas (nombre, sinonimo, nombrecomun) VALUES (:nombre, :sinonimo, :nombrecomun)');

// Recorrer los elementos y guardar los datos en la base de datos y en un archivo JSON
$data = [];
for ($i = 0; $i < $elements->length; $i += 4) {
    $nombre = $elements->item($i)->nodeValue;
    $sinonimo = $elements->item($i + 1)->nodeValue;
    $nombrecomun = $elements->item($i + 3)->nodeValue;

    // Insertar los datos en la base de datos
    $stmt->execute([
        'nombre' => $nombre,
        'sinonimo' => $sinonimo,
        'nombrecomun' => $nombrecomun,
    ]);

    // Guardar los datos en un archivo JSON
    $data[] = [
        'nombre' => $nombre,
        'sinonimo' => $sinonimo,
        'nombrecomun' => $nombrecomun,
    ];
}

file_put_contents('data.json', json_encode($data));

echo "Los datos se han guardado correctamente.\n";


$json = file_get_contents('data.json');

// Decodificar la cadena JSON en una variable PHP
$data = json_decode($json, true);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php foreach ($data as $seta) : ?>
        <div style="border: 2px solid black;">
            <h3>Nombre: <?= $seta['nombre'] ?></h3>
            <p> Sinonimo: <?= $seta['sinonimo'] ?></p>
            <p> nombrecomun: <?= $seta['nombrecomun'] ?></p>
        </div>

    <?php endforeach ?>
</body>

</html>
