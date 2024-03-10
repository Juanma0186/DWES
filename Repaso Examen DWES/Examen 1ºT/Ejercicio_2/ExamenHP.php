<?php

class ExamenHP extends AExamen
{
  protected const MIN_NOTA = 4;
  protected const MAX_NOTA = 4.5;
  public function obtenerNota(): int
  {
    //! Añadimos intval para poder hacer el random de enteros, sino nos diría que perdería precisión y pondría deprecated
    return rand(self::MIN_NOTA, intval(self::MAX_NOTA));
  }
}
