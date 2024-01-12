# *************
# SUMA REPETIDA
# *************


def run(n: int) -> int:
    # TU CÓDIGO AQUÍ

    # Creamos nn y nnn concatenado n
    nn = int(f"{n}{n}")
    nnn = int(f"{n}{n}{n}")

    if 0<= n <=9:
        result = n + nn + nnn
    else:
        return "El resultado deberá estar dentro del intervalo [0,9]"
    return result


if __name__ == '__main__':
    run(3)
