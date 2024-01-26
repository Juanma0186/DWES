# Tenemos la clase Moto tiene tipo "Scooter", "Naked" y "Custom"

from Vehiculo import Vehiculo

class Moto(Vehiculo):
    tipos = ["Scooter", "Naked", "Custom"]

    def __init__(self,matricula:str, ruedas:int, tipo:str) -> None:
        super().__init__(matricula,ruedas)
        self.tipo = tipo if tipo in self.tipos else "Scooter"

    def tocar_bocina(self) -> None:
        print("Meeeeeeeh")
