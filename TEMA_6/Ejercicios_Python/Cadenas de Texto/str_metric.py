# ********************************
# UNA MÉTRICA PARA CADENA DE TEXTO
# ********************************


def run(text: str) -> int:
    # TU CÓDIGO AQUÍ

    v_count = 0

    #
    for letter in text:
        if letter.lower() in "aeiou":
            v_count += 1

    result = len(text) * v_count

    return result


if __name__ == '__main__':
    run('ordenador')
