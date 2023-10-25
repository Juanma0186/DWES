<?php


class CocheGrua extends Coche
{

    //Atributos

    private $cocheCargado;

    //Constructor

    public function __construct(string $matricula, string $marca, int $carga, Coche $cocheCargado = null)
    {
        parent::__construct($matricula, $marca, $carga);
        $this->cocheCargado = $cocheCargado;
    }

    //Getters y Setters

    public function getCocheCargado(): Coche
    {
        return $this->cocheCargado;
    }

    public function cargar(Coche $cocheCargado): void //Sustituye al método setCocheCargado
    {
        if ($this->cocheCargado == null) {
            $this->cocheCargado = $cocheCargado;
        } else {
            echo "Ya hay un coche cargado";
        }
    }

    //Métodos

    public function descargar(): void
    {
        if ($this->cocheCargado != null) {
            $this->cocheCargado = null;
        } else {
            echo ". No hay ningún coche cargado";
        }
    }
    public function __toString(): string
    {
        $cadena = parent::__toString();
        if ($this->cocheCargado != null) {
            $cadena .= "\nLleva $this->cocheCargado";
        } else {
            $cadena .= ". Ningún coche cargado";
        }
        return $cadena;
    }
}
