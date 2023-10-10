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

  public static function crear()
  {
    echo "<form>";
    echo "Nombre: <input type='text' name='nombre'><br>";
    echo "Masa: <input type='text' name='masa'><br>";
    echo "Diámetro: <input type='text' name='diametro'><br>";
    echo "Distancia al Sol: <input type='text' name='distancia'><br>";
    echo "<button type='submit'>Crear</button>";
    echo "</form>";
  }

  public function mostrarFila()
  {
    echo "<tr>";
    echo "<td>$this->nombre</td>";
    echo "<td>$this->masa</td>";
    echo "<td>$this->diametro</td>";
    echo "<td>$this->distanciaSol</td></tr>";
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
