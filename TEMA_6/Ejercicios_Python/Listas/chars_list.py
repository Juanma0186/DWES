# **********************
# DESPLEGANDO CARACTERES
# **********************


def run(texts: list) -> list:
    # TU CÓDIGO AQUÍ
    chars = []

    for text in texts:
        for char in text:
            chars.append(char)

    return chars
    # return list(''.join(texts))
    

if __name__ == '__main__':
    run(['uno', 'dos', 'tres'])
