# *****************************
# SOMOS IGUALES, PERO DISTINTOS
# *****************************


def run(items: list) -> bool:
    # TU CÓDIGO AQUÍ
    all_same = items[0]

    for item in items:
        if item != all_same:
            return False

    return True


if __name__ == '__main__':
    run([1, 1, 1, 1, 1, 1])
