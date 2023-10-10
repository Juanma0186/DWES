<?php

include 'Planeta.php';

class SistemaSolar
{

  private $planetas = [];

  public function guardar()
  {
    $s = json_encode($this->planetas);
    if ($s === false) {
      echo "Error al codificar el JSON: " . json_last_error_msg();
    } else {
      if (file_put_contents("SistemaSolar.json", $s) === false) {
        echo "Error al escribir en el archivo.";
      } else {
        echo "Guardado exitosamente.";
      }
    }
  }

  public function cargar()
  {
    $json = file_get_contents("SistemaSolar.json");
    $data = json_decode($json);

    // Verificar si la decodificación JSON fue exitosa
    if ($data === null) {
      throw new Exception("Error al decodificar el archivo JSON");
    }

    // Crear un array para almacenar objetos de la clase Planeta
    $this->planetas = [];

    // Iterar sobre los datos y crear objetos de la clase Planeta
    foreach ($data as $planetaData) {
      $planeta = new Planeta($planetaData->nombre, $planetaData->masa, $planetaData->diametro, $planetaData->distanciaSol);

      // Agregar el objeto Planeta al array de planetas
      $this->planetas[] = $planeta;
    }
  }

  public function annadirPlaneta(Planeta $planeta)
  {
    $this->planetas = $planeta;
  }

  public function mostrar()
  {
    echo "<table>";
    echo "<tr><th>Nombre</th><th>Masa</th><th>Diametro</th><th>Distancia al Sol</th></tr>";

    foreach ($this->planetas as $planeta) {
      $planeta->mostrarFila();
    }
  }

  // public function mostrarTabla()
  // {
  //   $tabla = "<table><tr><th>Nombre</th><th>Masa</th><th>Diametro</th><th>Distancia al Sol</th></tr>";
  //   foreach ($this->planetas as $planeta) {
  //     $tabla .= $planeta->muestraFila();
  //   }
  //   $tabla .= "</table>";
  //   return $tabla;
  // }
}
