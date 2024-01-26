from Vehiculo import Vehiculo

class Coche(Vehiculo):
  def __init__(self, matricula:str, ruedas:int, puertas:int) -> None:
    super().__init__(matricula, ruedas)
    self.puertas = puertas

  def tocar_bocina(self) -> None:
    print("Pipiii")
