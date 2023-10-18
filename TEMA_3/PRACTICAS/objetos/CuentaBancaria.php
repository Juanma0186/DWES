<?php

/**
 * Clase para representar una Cuenta Bancaria
 */
class CuentaBancaria
{
  /** @var string $titular Titular de la cuenta */
  private $titular;

  /** @var float $saldo Saldo de la cuenta */
  private $saldo;

  /**
   * Constructor de la clase CuentaBancaria.
   * @param string $titular Titular de la cuenta.
   * @param float $saldoInicial Saldo inicial de la cuenta (opcional).
   */
  public function __construct($titular, $saldoInicial = 0)
  {
    $this->titular = $titular;
    $this->saldo = $saldoInicial;
  }

  /**
   * Deposita una cantidad a la cuenta.
   * @param float $cantidad Cantidad a depositar.
   */
  public function depositar($cantidad)
  {
    $this->saldo += $cantidad;
  }

  /**
   * Retira una cantidad de la cuenta.
   * @param float $cantidad Cantidad a retirar.
   * @return string Mensaje de éxito o error.
   */
  public function retirar($cantidad)
  {
    if ($this->saldo >= $cantidad) {
      $this->saldo -= $cantidad;
      return "Retirada realizada con éxito";
    } else {
      return "Saldo insuficiente";
    }
  }

  /**
   * Consulta el saldo de la cuenta.
   * @return float Saldo actual.
   */
  public function consultarSaldo()
  {
    return $this->saldo;
  }

  function fusionar(CuentaBancaria $origen)
  {
    $this->depositar($origen->consultarSaldo());
    $origen->retirar($origen->consultarSaldo());
    $this->titular = $this->titular . "(" . $origen->titular . ")";
    $origen->titular = "(deshabilitada)" . $origen->titular;
  }


  /**
   * Representación en cadena de texto del objeto.
   * @return string Representación en cadena del objeto.
   */
  public function __toString()
  {
    return "Titular: $this->titular, Saldo: $this->saldo";
  }
}
