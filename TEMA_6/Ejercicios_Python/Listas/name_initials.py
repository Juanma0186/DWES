# **********************
# INICIALES DE UN NOMBRE
# **********************


def run(fullname: str) -> str:
    # TU CÓDIGO AQUÍ

    # Dividimos el nombre completo
    partes = [parte.strip() for parte in fullname.split(",")]

    # Asignamos los nombres a su correspondiente
    apellidos,nombre = partes

    iniciales_a = ".".join([apellido[0].upper() for apellido in apellidos.split()])
    inicial_n = nombre[0].upper()

    # Le damos el formato deseado
    initials = f"{inicial_n}.{iniciales_a}."

    return initials


if __name__ == '__main__':
    run('Delgado Quintero, sergio')
