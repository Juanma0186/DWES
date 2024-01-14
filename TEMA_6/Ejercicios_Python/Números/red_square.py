# ****************
# EL CUADRADO ROJO
# ****************
import math
def run(arc_A: float) -> float:
    # TU CÓDIGO AQUÍ
    PI = 3.14
    L = arc_A * 4
    # Usando la formula de la longitud sacamos el radio L=2πR => R = L/2π
    R = L/(2*PI)
    return round(R**2,10)


if __name__ == '__main__':
    run(1)
