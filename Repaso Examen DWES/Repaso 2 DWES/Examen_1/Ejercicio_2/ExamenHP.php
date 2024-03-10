<?php

class ExamenHP extends AExamen
{
  protected const MAX_NOTA = 4.5;
  protected const MIN_NOTA = 4;

  public function obtenerNota(): int
  {
    return rand(self::MIN_NOTA, self::MAX_NOTA);
  }
}
