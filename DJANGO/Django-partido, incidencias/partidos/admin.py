from django.contrib import admin

# Register your models here.

from .models import Equipo, Incidencia, Partido

admin.site.register(Equipo)
admin.site.register(Partido)
admin.site.register(Incidencia)
