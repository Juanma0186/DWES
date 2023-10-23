<?php

class Coche
{

    //Atributos
    private $matricula;
    private $marca;
    private $carga;

    //Constructor

    public function __construct(string $matricula, string $marca, int $carga)
    {
        $this->matricula = $matricula;
        $this->marca = $marca;
        $this->carga = $carga;
    }

    //Getters y Setters

    public function getMasca(): string
    {
        return $this->marca;
    }

    public function setMarca(string $marca): void
    {
        $this->marca = $marca;
    }

    public function getMatricula(): string
    {
        return $this->matricula;
    }

    public function setMatricula(string $matricula): void
    {
        $this->matricula = $matricula;
    }

    public function getCarga(): int
    {
        return $this->carga;
    }

    public function setCarga(int $carga): void
    {
        $this->carga = $carga;
    }
    //Métodos

    public function __toString(): string
    {
        $cadena = "Coche: $this->matricula, $this->marca con carga: $this->carga";
        return $cadena;
    }
}
