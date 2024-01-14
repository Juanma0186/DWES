# ****************************
# CONVIRTIENDO HTML A MARKDOWN
# ****************************
import re

def run(html: str) -> str:
    # TU CÓDIGO AQUÍ

    # Patrones
    patrones = [
        (r"<h1>(.*?)<\/h1>", r"# \1"),
        (r"<h2>(.*?)<\/h2>", r"## \1"),
        (r"<h3>(.*?)<\/h3>", r"### \1"),
        (r"<h4>(.*?)<\/h4>", r"#### \1"),
    ]

    md = html
    for patron in patrones:
        md = re.sub(patron[0], patron[1], md)
        

    return md


if __name__ == '__main__':
    run('<h1>Core</h1>')
