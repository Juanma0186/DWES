# ************************************
# FRECUENCIA DE ELEMENTOS CONSECUTIVOS
# ************************************


def cfreq(items: list ,/, as_string=False):
    # TU CÓDIGO AQUÍ
    # Casos vacíos
    if not items:
        return [] if not as_string else ''

    result = []
    item_Actual = items[0]
    cont = 1

    for item in items[1:]:
        if item == item_Actual:
            cont += 1
        else:
            result.append((item_Actual, cont))
            item_Actual = item
            cont = 1

    result.append((item_Actual, cont))

    if as_string:
        return ','.join(f'{item}:{cont}' for item, cont in result)
    else:
        return result
