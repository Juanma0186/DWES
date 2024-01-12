# ****************
# NOMBRE VICEVERSA
# ****************


def run(fullname: str) -> str:
    # TU CÓDIGO AQUÍ
    partes = fullname.split(" ",1)
    name = partes[1] + " " + partes[0]

    return name


if __name__ == '__main__':
    run('John McClane')
