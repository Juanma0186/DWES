<?php

class ExamenChungo extends AExamen
{
  protected const MAX_NOTA = 10;

  protected const MIN_NOTA = 0;

  public function obtenerNota(): int
  {
    return rand(self::MIN_NOTA, self::MAX_NOTA);
  }
}
