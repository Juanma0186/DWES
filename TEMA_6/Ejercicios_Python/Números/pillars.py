# **********************
# POSTES EN LA CARRETERA
# **********************


def run(num_pillars: int, gap_pillars: float, pillar_width: float) -> float:
    # TU CÓDIGO AQUÍ
    inter_distance = (gap_pillars * (num_pillars - 1) * 100) + (pillar_width * (num_pillars - 2))

    return inter_distance


if __name__ == '__main__':
    run(10, 5, 30)
