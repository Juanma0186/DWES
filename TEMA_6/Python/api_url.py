# Función clousure que genere una url pasándole el protocolo como bool , el dominio y la entidad

def url_base(dominio:str,entidad:str, protocolo:bool = True):
    def url_extra(peticion:str, id:int = None):
        return ("http" if protocolo else "https") + "://" + dominio + "/" + entidad + "/" + peticion + ("/" + str(id) if id != None else "")
    return url_extra

url = url_base("www.google.com","api",False)
print(url("users",1))
print(url("users"))
print(url("users",2))
print(url("listado"))
