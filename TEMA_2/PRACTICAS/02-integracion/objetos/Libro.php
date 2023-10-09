<?php

/**
 * Clase para representar un Libro
 */
class Libro
{
  /** @var string $titulo Título del libro */
  public $titulo;

  /** @var string $autor Autor del libro */
  public $autor;

  /** @var string $ISBN Número ISBN del libro */
  public $ISBN;

  /** @var float $precio Precio del libro */
  public $precio;

  function __construct($titulo = "Libro Ejemplo", $autor = "Anónimo", $ISBN = "0000000", $precio = 9.9)
  {
    $this->titulo = $titulo;
    $this->autor = $autor;
    $this->ISBN = $ISBN;
    $this->precio = $precio;
  }

  /**
   * Muestra la información del libro.
   * @return string Información del libro.
   */
  public function mostrarInformacion()
  {
    return "Título: $this->titulo, Autor: $this->autor, ISBN: $this->ISBN, Precio: $this->precio";
  }

  /**
   * Cambia el precio del libro.
   * @param float $nuevoPrecio Nuevo precio del libro.
   */
  public function cambiarPrecio($nuevoPrecio)
  {
    $this->precio = $nuevoPrecio;
  }

  public function save(string $file_name, bool $json = true): void
  {
    file_put_contents($file_name, ($json ? json_encode($this) : serialize($this)));
  }

  public function load(string $file_name, bool $json = true): void
  {
    $libroTmp = null;
    $content = file_get_contents($file_name);
    if ($json) {
      $libroTmp = json_decode($content);
    } else {
      $libroTmp = unserialize($content);
    }

    $this->titulo = $libroTmp->titulo;
    $this->autor = $libroTmp->autor;
    $this->ISBN = $libroTmp->ISBN;
    $this->precio = $libroTmp->precio;
  }
}
