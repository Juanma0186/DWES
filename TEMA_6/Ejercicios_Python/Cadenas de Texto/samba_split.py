# ***********************
# SEPARANDO RECURSO SAMBA
# ***********************


def run(smb_path: str) -> tuple:
    # TU CÓDIGO AQUÍ
    
    #Buscamos la posición del doble slash
    double_slash = smb_path.find('//') + 2

    #Buscamos la posición de la barra que separa el host del path
    slash = smb_path.find('/', double_slash)

    #Extraemos el host y el path
    host = smb_path[double_slash:slash]
    path = smb_path[slash:]

    return host, path


if __name__ == '__main__':
    run('//1.1.1.1/aprende/python')
