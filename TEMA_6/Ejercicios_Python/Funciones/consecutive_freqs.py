# ************************************
# FRECUENCIA DE ELEMENTOS CONSECUTIVOS
# ************************************


def cfreq(items: list ,/, as_string:bool)->list|str:
# Casos vacíos
    if not items:
        return [] if not as_string else ''

# Resto de casos
    result = []

    # Inicializamos el primer elemento
    item_Actual = items[0]
    cont = 1

    # Recorremos la lista desde el segundo elemento
    for item in items[1:]:
        # Si es igual, incrementamos el contador
        if item == item_Actual:
            cont += 1
        # Si es distinto, guardamos el nuevo elemento y reiniciamos contador
        else:
            result.append((item_Actual, cont))
            item_Actual = item
            cont = 1

    # Guardamos el último elemento y su contador
    result.append((item_Actual, cont))

    # Devolvemos el resultado según as_string
    return ','.join(f'{item}:{cont}' for item, cont in result) if as_string else result
