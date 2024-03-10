<?php

interface IExamen
{

  function intentar(string $nombre): void;

  function obtenerNota(): int;
}
