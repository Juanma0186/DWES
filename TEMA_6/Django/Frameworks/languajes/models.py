from django.db import models

# Create your models here.

class Languaje(models.Model):
    name = models.CharField(max_length=50)
    creationDate = models.IntegerField()

    def __str__(self):
        return self.name

class Framework(models.Model):
    name = models.CharField(max_length=50)
    languaje = models.ForeignKey(Languaje, on_delete=models.CASCADE)
    creationDate = models.IntegerField()

    def __str__(self):
        return self.name
