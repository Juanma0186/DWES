# *************************
# NO ME INTERESAN LOS PARES
# *************************


def run(items: list) -> list:
    # TU CÓDIGO AQUÍ
    filter = []

    for i in range(len(items)):
        if (i+1)%2!=0:
            filter.append(items[i])

    return filter


if __name__ == '__main__':
    run([1, 2, 1, 2, 1, 2])
