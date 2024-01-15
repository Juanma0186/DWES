# ****************
# PRODUCTO ESCALAR
# ****************


def run(vector1: list, vector2: list) -> float:
    # TU CÓDIGO AQUÍ
    dprod = zip(vector1, vector2)
    dprod = sum([x * y for x, y in dprod]) if len(vector1)==len(vector2) else None 
    return dprod


if __name__ == '__main__':
    run([4, 3, 8, 1], [9, 2, 7, 3])
