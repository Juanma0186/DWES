<?php

class ExamenFacil extends AExamen
{
  protected const MIN_NOTA = 5;
  protected const MAX_NOTA = 10;
  public function obtenerNota(): int
  {
    return rand(self::MIN_NOTA, self::MAX_NOTA);
  }
}
