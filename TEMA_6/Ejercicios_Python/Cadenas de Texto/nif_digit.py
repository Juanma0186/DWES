# *************************
# DÍGITO DE CONTROL DEL NIF
# *************************


def run(nif: str) -> str:
    # TU CÓDIGO AQUÍ
    
    # Letras
    letters = "TRWAGMYFPDXBNJZSQVHLCKE"

    # Cogemos la letra correspondiente al resto
    letter = letters[int(nif) % 23]

    # Unimos para formar el DNI
    nif += letter

    return nif


if __name__ == '__main__':
    run('78654355')
