# *****************
# DECIMAL A BINARIO
# *****************


def run(num: int) -> str:
    # TU CÓDIGO AQUÍ

    to_bin = ""

    while num>0:
        to_bin = str(num%2) + to_bin
        num //= 2

    return to_bin


if __name__ == '__main__':
    run(1)
