# ***************
# PRECIO SIN IGIC
# ***************


def run(price_with_igic: float, igic: float) -> float:
    # TU CÓDIGO AQUÍ
    # Precio * 1.7 = Price_IGIC => Precio = Precio_IGIC / 1+(IGIC/100)
    clean_price = round(price_with_igic / (1+igic/100),2)

    return clean_price


if __name__ == '__main__':
    run(120, 7)
