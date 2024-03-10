from django.contrib import admin
from .models import Persona, Pareja

# Register your models here.

class PersonaAdmin(admin.ModelAdmin):
    list_display = ('nombre', 'apellido1', 'apellido2', 'descripcion')

admin.site.register(Persona, PersonaAdmin)
admin.site.register(Pareja)
