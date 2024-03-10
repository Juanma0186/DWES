from django.contrib import admin
from .models import Estacion, LineaMetro, Incidencia

# Register your models here.

class EstacionInLine(admin.StackedInline):
  model = Estacion
  extra = 0

class LineaMetroAdmin(admin.ModelAdmin):
  list_display = ('nombre', 'color', 'distancia')
  inlines = [EstacionInLine]

class IncidenciaAdmin(admin.ModelAdmin):
  # Al hacer el display sobreescribe el método __str__ de la clase Incidencia
  list_display = ('texto', 'fecha')
  list_filter = ['fecha']



admin.site.register(LineaMetro, LineaMetroAdmin)
admin.site.register(Estacion)
admin.site.register(Incidencia, IncidenciaAdmin)
