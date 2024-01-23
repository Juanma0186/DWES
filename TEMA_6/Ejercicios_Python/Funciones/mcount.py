# *******************
# CONTANDO SIN CONTAR
# *******************

"""[
    Función que cuenta el número de veces que aparece un elemento en una tupla.
    Si no se especifica el elemento a contar.
    Args:
        items (tuple[int]): [description]
        target (int, optional): [description]. Defaults to 0.
    Returns:
        int: [description]
"""
def mcount(items:tuple[int], target:int=0)->int:

    count = 0
    for i in items:
        if i == target:
            count += 1
    return count
