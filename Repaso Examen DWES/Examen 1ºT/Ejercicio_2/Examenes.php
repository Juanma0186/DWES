<?php

spl_autoload_register(function ($class) {
  include $class . '.php';
});

$examenFacil = new ExamenFacil();
$examenChungo = new ExamenChungo();
$examenHP = new ExamenHP();

$examenFacil->intentar('Facil');
$examenChungo->intentar('Chungo');
$examenHP->intentar('HP');

$examenFacil->setFecha('2020-10-10');
$examenChungo->setFecha('2023-10-10');
$examenHP->setFecha('2025-10-10');

echo 'Examen Facil: ';
echo $examenFacil->obtenerNota();
echo 'Fecha: ';
echo $examenFacil->getFecha();
echo '<br/>';

echo 'Examen Chungo: ';
echo $examenChungo->obtenerNota();
echo 'Fecha: ';
echo $examenChungo->getFecha();
echo '<br/>';

echo 'Examen HP: ';
echo $examenHP->obtenerNota();
echo 'Fecha: ';
echo $examenHP->getFecha();
