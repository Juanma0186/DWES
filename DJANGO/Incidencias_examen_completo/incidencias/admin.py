from django.contrib import admin
from .models import Linea, Estacion, Incidencia
# Register your models here.

class EstacionInline(admin.TabularInline):
    model = Estacion
    extra=0

class LineaAdmin(admin.ModelAdmin):
    inlines = [
        EstacionInline,
    ]
    # fieldsets = [
    #     ("Información Linea", {"fields": ['nombre', 'distancia']}), #! fieldsets es para agrupar campos en el formulario de admin de una misma tabla
    #     ("Color de linea", {"fields": ['color']}),
    # ]
    list_display = ('nombre', 'color', 'distancia')


class IncidenciaAdmin(admin.ModelAdmin):
    list_display = ('texto', 'fecha')
    list_filter = ('fecha',)

admin.site.register(Linea, LineaAdmin)
admin.site.register(Incidencia, IncidenciaAdmin)    
admin.site.register(Estacion)

#! DEL TUTORIAL DE DJANGO PARA HACER LO DE FIELDSET EN FORMULARIOS
#? class QuestionAdmin(admin.ModelAdmin):
#?     fieldsets = [
#?         (None, {"fields": ["question_text"]}),
#?        ("Date information", {"fields": ["pub_date"]}),
#?    ]


#? admin.site.register(Question, QuestionAdmin)

#! DEL TUTORIAL DE DJANGO PARA TENER DOS MODELOS EN UNA SOLA PAGINA

# class ChoiceInline(admin.TabularInline):
#     model = Choice
#     extra = 0


# class QuestionAdmin(admin.ModelAdmin):
#     fieldsets = [
#         (None, {"fields": ["question_text"]}),
#         ("Date information", {"fields": ["pub_date"], "classes": ["collapse"]}),
#     ]
#     inlines = [ChoiceInline]


# admin.site.register(Question, QuestionAdmin)