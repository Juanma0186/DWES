# *********************
# CONTANDO MILISEGUNDOS
# *********************


def run(hours: int, minutes: int, seconds: int) -> float:
    # TU CÓDIGO AQUÍ
    time_since_midnight = (hours*3600 + minutes*60 + seconds) * 1000

    return time_since_midnight


if __name__ == '__main__':
    run(0, 1, 1)
