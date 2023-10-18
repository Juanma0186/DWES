<?php

class CocheConRemolque extends Coche
{

  //Atributos

  private int $capacidad;

  //Constructor

  public function __construct(string $matricula, string $marca, int $carga, int $capacidad)
  {
    parent::__construct($matricula, $marca, $carga);
    $this->capacidad = $capacidad;
  }

  //Getters y Setters

  public function getCapacidad(): int
  {
    return $this->capacidad;
  }

  public function setCapacidad(int $capacidad): void
  {
    $this->capacidad = $capacidad;
  }

  //Métodos

  public function __toString(): string
  {
    $cadena = parent::__toString() . " y remolque de $this->capacidad kg";
    return $cadena;
  }
}
