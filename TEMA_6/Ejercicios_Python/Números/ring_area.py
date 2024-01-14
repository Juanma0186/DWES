# ***************
# ÁREA DEL ANILLO
# ***************


def run(z: float) -> float:
    # TU CÓDIGO AQUÍ
    PI = 3.14
    r = z/2
    return PI*(z+r)**2 - PI*r**2


if __name__ == '__main__':
    run(6)
