<?php
//errores
//composer require guzzlehttp/guzzle:^7.0
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require('vendor/autoload.php');

use GuzzleHttp\Client;

$client = new Client([
    'base_uri' => 'http://meneame.net',
    'timeout'  => 2.0,
    'verify' => false
]);

$response = $client->request('GET', '/');

echo 'Status: ' . $response->getStatusCode() . "\n";

$content = (string) $response->getBody();

libxml_use_internal_errors(true);
$doc = new DOMDocument();
$doc->loadHTML($content);
$xpath = new DOMXPath($doc);

$titles = $xpath->query('//*/h2');
foreach ($titles as $title) {
    echo $title->nodeValue . "\n";
}
