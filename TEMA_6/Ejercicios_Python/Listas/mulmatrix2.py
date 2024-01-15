# *****************************
# MULTIPLICANDO MATRICES DE 2X2
# *****************************


def run(A: list, B: list) -> list:
    # TU CÓDIGO AQUÍ
    P = []
    for i in range(len(A)):
        P.append([])
        for j in range(len(B[0])):
            P[i].append(0)
            for k in range(len(A[0])):
                P[i][j] += A[i][k] * B[k][j]

    return P


if __name__ == '__main__':
    run([[6, 4], [8, 9]], [[3, 2], [1, 7]])
