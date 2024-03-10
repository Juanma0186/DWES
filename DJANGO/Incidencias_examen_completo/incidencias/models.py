from django.db import models
from django.utils import timezone
from django.contrib import admin

# Create your models here.

class Linea(models.Model):
    nombre = models.CharField(max_length=50)
    color = models.CharField(max_length=50)
    distancia=models.FloatField()
    
    def __str__(self) -> str:
       return self.nombre
   
    # @admin.display(boolean=True, ordering='distancia', description='¿Distancia mayor a 100?')
    # def distancia_mayor_a_100(self, obj):
    #     return obj.distancia < 5
    
class Estacion(models.Model):
    nombre= models.CharField(max_length=50)
    linea=models.ForeignKey(Linea,  on_delete=models.CASCADE,related_name="estaciones")

    class Meta:
        verbose_name_plural = "Estaciones"
        
    def __str__(self) ->str:
        return self.nombre
    
class Incidencia(models.Model):
    texto=models.TextField(max_length=50)
    fecha=models.DateField(default=timezone.now)#! default=timezone.now si puede editar    ||||  auto_now_add=True no puede editar la fecha
    estacion=models.ForeignKey(Estacion,on_delete=models.CASCADE)

    def __str__(self) -> str:
        return f"{self.estacion.nombre} ({self.estacion.linea.nombre} {self.texto } )"


#! ORM SHELL

#! CREAR OBJETOS
# # Crear una nueva Linea
# linea = Linea.objects.create(nombre="Linea 1", color="Azul", distancia=10.5)

# # Crear una nueva Estacion asociada a la Linea que acabamos de crear
# estacion = Estacion.objects.create(nombre="Estacion 1", linea=linea)

# # Crear una nueva Incidencia asociada a la Estacion que acabamos de crear
# incidencia = Incidencia.objects.create(texto="Incidencia 1", estacion=estacion)



# # Obtener un objeto por su ID
# linea = Linea.objects.get(id=1)

# # Obtener un objeto por un campo que no es la ID
# linea = Linea.objects.get(nombre="Linea 1")

# # Obtener todos los objetos que cumplen con un criterio
# lineas_rojas = Linea.objects.filter(color="Rojo")

# # Ordenar los objetos por un campo
# lineas_ordenadas = Linea.objects.order_by('distancia')

# # Excluir objetos que cumplen con un criterio
# lineas_no_rojas = Linea.objects.exclude(color="Rojo")

# # Actualizar campos de un objeto
# linea.color = "Azul"
# linea.save()

# # Actualizar campos de varios objetos a la vez
# Linea.objects.filter(color="Rojo").update(color="Azul")

# # Eliminar un objeto
# linea.delete()

# # Eliminar varios objetos a la vez
# Linea.objects.filter(color="Azul").delete()


#! ORM DEL TUTORIAL DE DJANGO>>> from polls.models import Choice, Question  # Import the model classes we just wrote.

# # No questions are in the system yet.
# >>> Question.objects.all()
# <QuerySet []>

# # Create a new Question.
# # Support for time zones is enabled in the default settings file, so
# # Django expects a datetime with tzinfo for pub_date. Use timezone.now()
# # instead of datetime.datetime.now() and it will do the right thing.
# >>> from django.utils import timezone
# >>> q = Question(question_text="What's new?", pub_date=timezone.now())

# # Save the object into the database. You have to call save() explicitly.
# >>> q.save()

# # Now it has an ID.
# >>> q.id
# 1

# # Access model field values via Python attributes.
# >>> q.question_text
# "What's new?"
# >>> q.pub_date
# datetime.datetime(2012, 2, 26, 13, 0, 0, 775217, tzinfo=datetime.timezone.utc)

# # Change values by changing the attributes, then calling save().
# >>> q.question_text = "What's up?"
# >>> q.save()

# # objects.all() displays all the questions in the database.
# >>> Question.objects.all()
# <QuerySet [<Question: Question object (1)>]>




# # Make sure our __str__() addition worked.
# >>> Question.objects.all()
# <QuerySet [<Question: What's up?>]>

# # Django provides a rich database lookup API that's entirely driven by
# # keyword arguments.
# >>> Question.objects.filter(id=1)
# <QuerySet [<Question: What's up?>]>
# >>> Question.objects.filter(question_text__startswith="What")
# <QuerySet [<Question: What's up?>]>

# # Get the question that was published this year.
# >>> from django.utils import timezone
# >>> current_year = timezone.now().year
# >>> Question.objects.get(pub_date__year=current_year)
# <Question: What's up?>


#! uso del incidencias_set.all() 
#  q = Question.objects.get(pk=1)

# # Display any choices from the related object set -- none so far.
# >>> q.choice_set.all()
# <QuerySet []>

# # Create three choices.
# >>> q.choice_set.create(choice_text="Not much", votes=0)
# <Choice: Not much>
# >>> q.choice_set.create(choice_text="The sky", votes=0)
# <Choice: The sky>
# >>> c = q.choice_set.create(choice_text="Just hacking again", votes=0)

# # Choice objects have API access to their related Question objects.
# >>> c.question
# <Question: What's up?>

# # And vice versa: Question objects get access to Choice objects.
# >>> q.choice_set.all()
# <QuerySet [<Choice: Not much>, <Choice: The sky>, <Choice: Just hacking again>]>
# >>> q.choice_set.count()
# 3


#! para personalizar el admin con el @admin
# from django.contrib import admin


# class Question(models.Model):
#     # ...
#     @admin.display(
#         boolean=True,
#         ordering="pub_date",
#         description="Published recently?",
#     )
#     def was_published_recently(self):
#         now = timezone.now()
#         return now - datetime.timedelta(days=1) <= self.pub_date <= now