<?php

trait TieneFecha
{

  protected $fecha;

  public function getFecha()
  {
    return $this->fecha;
  }

  public function setFecha($fecha)
  {
    $this->fecha = $fecha;
  }
}
abstract class AExamen implements IExamen
{
  // Usamos el trait
  use TieneFecha;
  protected $nombre;
  public function intentar(string $nombre)
  {
    $this->nombre = $nombre;
  }
}
