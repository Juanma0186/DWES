# *************************
# LA MULTIPLICACIÓN DE JACK
# *************************


def run(n: int) -> int:
    # TU CÓDIGO AQUÍ
    # Calculamos el numero de dígitos que tiene
    num_dig = len(str(abs(n)))
    result = n * 5 ** num_dig

    return result


if __name__ == '__main__':
    run(3)
