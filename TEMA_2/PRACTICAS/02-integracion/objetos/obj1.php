<?php

/**
 * Clase para representar un Libro
 */
class Libro {
  /** @var string $titulo Título del libro */
  public $titulo;
  
  /** @var string $autor Autor del libro */
  public $autor;
  
  /** @var string $ISBN Número ISBN del libro */
  public $ISBN;
  
  /** @var float $precio Precio del libro */
  public $precio;

  /**
   * Muestra la información del libro.
   * @return string Información del libro.
   */
  public function mostrarInformacion() {
      return "Título: $this->titulo, Autor: $this->autor, ISBN: $this->ISBN, Precio: $this->precio";
  }

  /**
   * Cambia el precio del libro.
   * @param float $nuevoPrecio Nuevo precio del libro.
   */
  public function cambiarPrecio($nuevoPrecio) {
      $this->precio = $nuevoPrecio;
  }

  /**
   * Guarda la información del libro en un archivo.
   * @param string $archivo Nombre del archivo donde se guardará la información.
   * @return bool true si la operación fue exitosa, false en caso contrario.
   */
  public function save($archivo) {
      $datos = serialize($this); // Serializa el objeto Libro
      return file_put_contents($archivo, $datos) !== false;
  }

  /**
   * Carga la información de un libro desde un archivo.
   * @param string $archivo Nombre del archivo desde donde se cargará la información.
   * @return Libro|null Objeto Libro cargado desde el archivo o null si no se pudo cargar.
   */
  public static function load($archivo) {
      if (file_exists($archivo)) {
          $datos = file_get_contents($archivo);
          if ($datos !== false) {
              $libro = unserialize($datos); // Deserializa el objeto Libro
              if ($libro instanceof Libro) {
                  return $libro;
              }
          }
      }
      return null;
  }
}
