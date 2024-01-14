# ****************************************
# ENCONTRANDO EL PRIMER Y EL ÚLTIMO DÍGITO
# ****************************************


def run(text: str) -> tuple:
    # TU CÓDIGO AQUÍ
    first_digit = last_digit = ""

    # Empezamos por el principio para sacar el primer dígito
    for char in text:
        if char.isdigit():
            first_digit = int(char)
            break;
        else:
            first_digit = None

# Empezamos por el final para sacar el último dígito
    for char in reversed(text):
        if char.isdigit():
            last_digit = int(char)
            break;
        else:
            last_digit = None

    return first_digit, last_digit


if __name__ == '__main__':
    run('1abc2')
