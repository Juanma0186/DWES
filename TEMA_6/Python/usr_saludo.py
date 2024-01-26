
def saludador(name:str):
  def di_algo(msg:str):
    print(f"{name}: {msg}")
  return di_algo

dice = saludador("Jorge")
dice("Hola!!")

