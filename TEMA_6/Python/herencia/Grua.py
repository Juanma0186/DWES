from Vehiculo import Vehiculo
# Clase Grúa contiene Vehículos

class Grua(Vehiculo):
  def __init__(self, matricula:str, ruedas:int, vehiculos:list) -> None:
    super().__init__(matricula, ruedas)
    self.vehiculos = vehiculos

  def tocar_bocina(self) -> None:
    print("Turuuu")

  def list_vehiculos(self) -> None:
    cadena = "Vehiculos en la grúa"
    for vehiculo in self.vehiculos:
      cadena += "\n" + vehiculo.matricula
    print(cadena)
