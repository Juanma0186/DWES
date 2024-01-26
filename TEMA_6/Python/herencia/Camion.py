from Vehiculo import Vehiculo

class Camion(Vehiculo):
  def __init__(self, matricula:str, ruedas:int, carga:int) -> None:
    super().__init__(matricula, ruedas)
    self.carga = carga

  def tocar_bocina(self) -> None:
    print("Mooooook")

  def get_carga(self) -> None:
    print(f"La carga del camión es {self.carga} kg")
