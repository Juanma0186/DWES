# *****************************
# SUMA DE LA DIAGONAL PRINCIPAL
# *****************************


def run(matrix: list) -> int:
    # TU CÓDIGO AQUÍ

    sum_diagonal = 0
    # Comprobamos que la matriz sea cuadrada
    for item in matrix:
        if(len(item)!=len(matrix)):
            return None

    # Hacemos la suma de la diagonal
    for i in range(len(matrix)):
        for j in range(len(matrix)):
            if i==j:
                sum_diagonal += int(matrix[i][j])

    return sum_diagonal


if __name__ == '__main__':
    run([[4, 6, 1], [2, 9, 3], [1, 7, 7]])
