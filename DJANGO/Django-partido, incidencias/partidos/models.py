from django.db import models
from django.core.exceptions import ValidationError
from django.db import models

#

class Equipo(models.Model):
  nombre = models.CharField(max_length=50)
  año_fundacion = models.IntegerField(default=0000)
  ciudad = models.CharField(max_length=50,default="")

  def __str__(self):
      return self.nombre



class Partido(models.Model):
  fecha = models.DateField()
  local = models.ForeignKey(Equipo, on_delete=models.CASCADE, related_name="partidos_local")
  visitante = models.ForeignKey(Equipo, on_delete=models.CASCADE, related_name="partidos_visitante")
  resultado_local = models.IntegerField()
  resultado_visitante = models.IntegerField()

  def __str__(self):
    return f"{self.local} vs {self.visitante} - {self.fecha} - ({self.resultado_local} - {self.resultado_visitante})"

  # Validación de que el equipo local y el visitante sean distintos
  def clean(self):
    if self.local == self.visitante:
      raise ValidationError("El equipo local y el visitante deben ser distintos")

class Incidencia(models.Model):
  titulo = models.CharField(max_length=50)
  desciption = models.TextField()
  email = models.EmailField()

  def __str__(self):
    return self.titulo
