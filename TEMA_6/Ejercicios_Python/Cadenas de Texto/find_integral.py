# *********************
# ENCUENTRA LA INTEGRAL
# *********************


def run(symbol: str) -> str:
    # TU CÓDIGO AQUÍ

    coma_pos = symbol.find(",")
    n2 = int(symbol[coma_pos + 1:]) + 1
    
    # Operador // para hacer una división entera y no tener decimales
    n1 = int(symbol[:coma_pos]) // n2

    return f"{n1}x^{n2}"


if __name__ == '__main__':
    run('3,2')
