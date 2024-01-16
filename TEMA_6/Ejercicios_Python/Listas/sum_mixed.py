# ****************
# SUMA HETEROGÉNEA
# ****************


def run(items: list) -> int:
    # TU CÓDIGO AQUÍ
    sum_items = 0

    # Transformamos todo a int y sumamos
    for item in items:
        sum_items += int(item)

    return sum_items


if __name__ == '__main__':
    run([1, '2', 3, '4', 5])
