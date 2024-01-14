# ******************
# DISTANCIA EUCLÍDEA
# ******************


def run(x1: float, y1: float, x2: float, y2: float) -> float:
    # TU CÓDIGO AQUÍ
    # d = √((x2 - x1)² + (y2 - y1)²)
    # Se usa el exponente 0.5 para realizar la raíz cuadrada sin importar MATH
    distance = ((x2 - x1)**2 + (y2 -y1)**2)**0.5

    return distance


if __name__ == '__main__':
    run(3, 5, -7, -4)
