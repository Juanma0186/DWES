# ************************************
# CALCULANDO EL FACTORIAL DE UN NÚMERO
# ************************************

# Recursivo
def factorial_rec(n):
    if n == 0:
        return 1
    elif n < 0:
        return None
    else:
        return n * factorial(n-1)

# No recursivo
def factorial(n):
    factorial = 0
    if n < 0:
        return None
    else:
        factorial = 1
        for i in range(1, n+1):
            factorial *= i
    return factorial
