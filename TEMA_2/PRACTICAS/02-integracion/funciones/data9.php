<?php

$evento1 = [
  "nombre" => "Evento 1",
  "fecha" => "2023-12-23",
  "lugar" => "Barcelona",
  "piñata" => false
];

$evento2 = [
  "nombre" => "Evento 2",
  "fecha" => "2023-10-05",
  "lugar" => "Madrid",
  "piñata" => true
];

function mostrarEvento(array $evento): void
{
  printf(
    "
    <div class='evento'>
    <h2>%s</h2>
    <p>Fecha: %s</p>
    <p>Lugar: %s</p>
    <p>Piñata: %s</p>    
    </div>",
    $evento["nombre"],
    $evento["fecha"],
    $evento["lugar"],
    $evento["piñata"] ? "Si" : "No"
  );
}


function editarEvento()
{
}

function tablaEvento()
{
}
