# *************
# N ELEVADO A N
# *************


def run(values: list, power: int) -> int:
    # TU CÓDIGO AQUÍ
    result = values[power]**power if power < len(values) else -1

    return result


if __name__ == '__main__':
    run([1, 2, 3, 4], 2)
