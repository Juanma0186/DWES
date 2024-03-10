<?php

trait TieneFecha
{
  protected $fecha;

  public function getFecha()
  {
    return $this->fecha;
  }

  public function setFecha(string $fecha)
  {
    $this->fecha = $fecha;
  }
}
