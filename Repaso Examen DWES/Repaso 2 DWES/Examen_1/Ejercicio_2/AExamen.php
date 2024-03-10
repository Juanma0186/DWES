<?php

abstract class AExamen implements IExamen
{
  use TieneFecha;
  protected $nombre;
  public function intentar(string $nombre): void
  {
    $this->nombre = $nombre;
  }
}
