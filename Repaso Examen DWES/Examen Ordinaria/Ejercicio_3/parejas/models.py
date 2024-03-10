from django.db import models

class Persona(models.Model):
  nombre = models.CharField(max_length=50)
  apellido1 = models.CharField(max_length=50)
  apellido2 = models.CharField(max_length=50)
  descripcion = models.TextField()

  def __str__(self):
    return self.nombre

class Pareja(models.Model):
  persona1 = models.ForeignKey(Persona, on_delete=models.CASCADE, related_name="persona1")
  persona2 = models.ForeignKey(Persona, on_delete=models.CASCADE, related_name="persona2")
  fecha_inicio = models.DateField()
  lugar = models.CharField(max_length=50)

  def __str__(self):
    return f'{self.persona1.apellido1}, {self.persona2.apellido1} ({self.fecha_inicio})'
