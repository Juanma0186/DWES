# ************
# VALOR MÁXIMO
# ************


def run(values: list) -> int:
    # TU CÓDIGO AQUÍ
    max_value = values[0]

    for value in values:
        if max_value < value:
            max_value = value

    return max_value


if __name__ == '__main__':
    run([-11, 10, -6, 15, -1])
