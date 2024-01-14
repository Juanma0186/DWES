# ***
# XOR
# ***


def run(v1: bool, v2: bool) -> bool:
    # TU CÓDIGO AQUÍ
    if bool(v1) == bool(v2):
        return False
    else:
        return v1 | v2

if __name__ == '__main__':
    run(False, False)
