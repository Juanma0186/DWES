<?php

class Planeta implements JsonSerializable
{
  //Atributos
  private $nombre;
  private $masa;
  private $diametro;
  private $distanciaSol;

  //Constructor

  public function __construct(string $nombre, float $masa, float $diametro, float $distanciaSol)
  {
    $this->nombre = $nombre;
    $this->masa = $masa;
    $this->diametro = $diametro;
    $this->distanciaSol = $distanciaSol;
  }

  //Getters

  public function setNombre(string $nombre)
  {
    $this->nombre = $nombre;
  }

  public function setMasa(float $masa)
  {
    $this->masa = $masa;
  }

  public function setDiametro(float $diametro)
  {
    $this->diametro = $diametro;
  }

  public function setDistanciaSol(float $distanciaSol)
  {
    $this->distanciaSol = $distanciaSol;
  }

  //Getters

  public function getNombre(): string
  {
    return $this->nombre;
  }

  public function getMasa(): float
  {
    return $this->masa;
  }

  public function getDiametro(): float
  {
    return $this->diametro;
  }

  public function getDistanciaSol(): float
  {
    return $this->distanciaSol;
  }

  //Métodos

  public function mostrar(string $container = "div", string $etiqueta = "span")
  {
    echo "<$container>";
    echo "<$etiqueta>Nombre: $this->nombre</$etiqueta>";
    echo "<$etiqueta>Masa: $this->masa</$etiqueta>";
    echo "<$etiqueta>Diametro: $this->diametro</$etiqueta>";
    echo "<$etiqueta>Distancia al Sol: $this->distanciaSol</$etiqueta>";
    echo "</$container>";
  }

  public function editar()
  {
    /*Pinta un form para editar los datos del planeta y que al darle a submit se guarden los cambios */
    echo "<form action='index.php' method='POST'>";
    echo "<input type='text' name='nombre' value='$this->nombre'>";
    echo "<input type='text' name='masa' value='$this->masa'>";
    echo "<input type='text' name='diametro' value='$this->diametro'>";
    echo "<input type='text' name='distanciaSol' value='$this->distanciaSol'>";
    echo "<button type='submit'>Guardar cambios</button>";
    echo "</form>";
  }


  public function crear()
  {
    /*Pinta un form para crear un nuevo planeta y que al darle a submit se guarde en el json */
    echo "<form action='index.php' method='POST'>";
    echo "<input type='text' name='nombre' placeholder='Nombre'>";
    echo "<input type='text' name='masa' placeholder='Masa'>";
    echo "<input type='text' name='diametro' placeholder='Diametro'>";
    echo "<input type='text' name='distanciaSol' placeholder='Distancia al Sol'>";
    echo "<button type='submit'>Guardar cambios</button>";
    echo "</form>";
  }


  public function jsonSerialize(): mixed
  {
    return [
      'nombre' => $this->nombre,
      'masa' => $this->masa,
      'diametro' => $this->diametro,
      'distanciaSol' => $this->distanciaSol
    ];
  }

  public function __toString()
  {
    return "Nombre: $this->nombre, Masa: $this->masa, Diametro: $this->diametro, Distancia al Sol: $this->distanciaSol";
  }
}
