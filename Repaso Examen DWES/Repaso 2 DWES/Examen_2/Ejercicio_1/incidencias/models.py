from django.db import models
# Create your models here.

class LineaMetro(models.Model):
  nombre = models.CharField(max_length=100)
  color = models.CharField(max_length=100)
  distancia = models.FloatField()

  def __str__(self):
      return self.nombre

