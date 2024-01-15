import sys

# En values tendremos una lista con los valores (como strings)
values = sys.argv[1:]

# Su código debajo de aquí
values = [int(valor) for valor in values]
values = round(sum(values)/len(values),2)

print(f'La media es {values:.2f}')
