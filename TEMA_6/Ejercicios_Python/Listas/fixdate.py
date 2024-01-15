# ********************
# REORGANIZANDO FECHAS
# ********************


def run(input_date: str, base_year: int) -> str:
    # TU CÓDIGO AQUÍ
    input_date = input_date.split("/")
    anno = int(input_date[2]) + base_year
    
    # Con zfill() rellenamos con ceros a la izquierda hasta completar el número de caracteres indicado
    output_date = f"{input_date[1].zfill(2)}-{input_date[0].zfill(2)}-{anno}"

    return output_date


if __name__ == '__main__':
    run('12/31/23', 2000)
