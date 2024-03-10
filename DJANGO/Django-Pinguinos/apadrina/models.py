from django.db import models
# Create your models here.

class Pinguino(models.Model):
  nombre = models.CharField(max_length=100)
  descripcion = models.TextField()
  adoptado = models.BooleanField(default=False)
  imagen = models.ImageField(upload_to='fotos')

  def __str__(self) -> str:
    return self.nombre
