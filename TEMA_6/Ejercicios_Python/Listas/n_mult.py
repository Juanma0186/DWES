# ********************
# CALCULANDO MÚLTIPLOS
# ********************


def run(x: int, n: int) -> list:
    # TU CÓDIGO AQUÍ
    multiples = [(x*i) for i in range(1,n+1)]

    return multiples


if __name__ == '__main__':
    run(1, 10)
