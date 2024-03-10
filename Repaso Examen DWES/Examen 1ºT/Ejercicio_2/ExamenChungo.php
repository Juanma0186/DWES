<?php

class ExamenChungo extends AExamen
{
  protected const MIN_NOTA = 0;
  protected const MAX_NOTA = 7;
  public function obtenerNota(): int
  {
    return rand(self::MIN_NOTA, self::MAX_NOTA);
  }
}
