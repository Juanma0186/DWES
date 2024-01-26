#? Tenemos la clase Vehículo con matrícula y número de ruedas recibidos en el constructor.
# Tenemos la clase Moto tiene tipo "Scooter", "Naked" y "Custom"
# Tenemos la clase Coche que tiene número de puertas
# Clase Grúa contiene Vehículos
# Camión con carga
# Método común tocar_bocina
# Motos --> Meeeeeeeh
# Coche --> pipiii
# Grúa --> Turuuu
# Camión --> Mooooook

class Vehiculo:
    def __init__(self,matricula:str, ruedas:int) -> None:
        self.matricula = matricula
        self.ruedas = ruedas

    def tocar_bocina(self) -> None:
        pass
