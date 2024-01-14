# **************************
# BUSCANDO EL SIGLO ADECUADO
# **************************


def run(year: int) -> int:
    # TU CÓDIGO AQUÍ
    # Cogemos los 2 primeros dígitos
    century = year // 100
    if(year%100 >= 1):
        century += 1
    

    return century


if __name__ == '__main__':
    run(1705)
