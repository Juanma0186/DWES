# *********************
# ENCONTRANDO ISOGRAMAS
# *********************


def run(text: str) -> bool:
    # TU CÓDIGO AQUÍ
    is_isogram = True
    letrasUnicas = []
    text = text.replace('-', '')

    for letra in text:
        if letra not in letrasUnicas:
            letrasUnicas.append(letra)
        else:
            is_isogram = False
            break
    return is_isogram



if __name__ == '__main__':
    run('lumberjacks')
