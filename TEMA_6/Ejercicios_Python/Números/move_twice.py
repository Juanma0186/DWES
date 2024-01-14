# *******************
# TIRO PORQUE ME TOCA
# *******************


def run(current_pos: int, dice: int) -> int:
    # TU CÓDIGO AQUÍ
    final_pos = current_pos + 2 * dice

    return final_pos


if __name__ == '__main__':
    run(3, 6)
