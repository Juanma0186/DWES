from Coche import Coche
from Moto import Moto
from Grua import Grua
from Camion import Camion



coche = Coche("1234ABC", 4, 5)
coche.tocar_bocina()
print("\n")

moto = Moto("1234ABC", 2, "Naked")
print(moto.tipo)
moto.tocar_bocina()
print("\n")

moto2 = Moto("1234ABC", 2, "Prueba")
print(moto2.tipo)
moto2.tocar_bocina()
print("\n")

grua = Grua("1234ABC", 4, [coche, moto])
grua.tocar_bocina()
grua.list_vehiculos()
print("\n")

camion = Camion("1234ABC", 4, 1000)
camion.tocar_bocina()
camion.get_carga()

