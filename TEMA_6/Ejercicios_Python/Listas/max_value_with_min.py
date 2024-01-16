# ************
# VALOR MÁXIMO
# ************


def run(values: list) -> int:
    # TU CÓDIGO AQUÍ

    # Invertimos los signos de la lista
    inv_values = [-value for value in values]

    # El valor máximo será el invertido del mínimo
    max_value = -min(inv_values)

    return max_value


if __name__ == '__main__':
    run([-11, 10, -6, 15, -1])
