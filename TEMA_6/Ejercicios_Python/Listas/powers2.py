# **************
# POTENCIAS DE 2
# **************


def run(num_powers: int) -> list:
    # TU CÓDIGO AQUÍ

    # powers2 = []

    # for i in range(0,num_powers+1):
    #     powers2.append(2**i)

    # return powers2

    # Lista por comprensión
    powers2 = [(2**i) for i in range(0,num_powers+1)]

    return powers2

if __name__ == '__main__':
    run(0)
