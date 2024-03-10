from django.db import models

# Create your models here.

class LineaMetro(models.Model):
  nombre = models.CharField(max_length=100)
  color = models.CharField(max_length=100)
  distancia = models.FloatField()

  def __str__(self):
    return self.nombre

class Estacion(models.Model):
  nombre = models.CharField(max_length=100)
  linea = models.ForeignKey(LineaMetro, on_delete=models.CASCADE)

  def __str__(self):
      return self.nombre

class Incidencia(models.Model):
  texto = models.TextField()
  fecha = models.DateField()
  estacion = models.ForeignKey(Estacion, on_delete=models.CASCADE)

  def __str__(self):
      return f'{self.estacion.nombre}({self.estacion.linea.nombre}), {self.texto}'


