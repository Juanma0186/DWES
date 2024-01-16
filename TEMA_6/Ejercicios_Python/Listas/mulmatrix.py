# **********************
# MULTIPLICANDO MATRICES
# **********************


def run(A: list, B: list) -> list:
    # TU CÓDIGO AQUÍ
    # Inicializamos con 0 la lista de resultados
    P = [[0 for _ in range(len(B[0]))] for _ in range(len(A))]

    # Comprobamos el tamaño de las matrices
    if len(A[0]) != len(B):
        return None

    # Itera sobre las filas
    for i in range(len(A)):
        # Itera sobre las columnas
        for j in range(len(B[0])):
            # Itera sobre los elementos de la matriz
            for k in range(len(B)):
                P[i][j] += A[i][k] * B[k][j]

    return P


if __name__ == '__main__':
    run([[1, 2, 3], [4, 5, 6]], [[5, -1], [1, 0], [-2, 3]])
