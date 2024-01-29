from django.shortcuts import render
from django.http import HttpResponse

# Create your views here.
from .models import Languaje, Framework

def languajes(request):
    tabla = '<table style="border:3px solid"><tr><th>Lenguaje</th><th>Framework</th></tr>'
    for languaje  in Languaje.objects.all():
        tabla += '<tr><td>' + languaje.name + '</td><td>'
        for framework in Framework.objects.filter(languaje=languaje):
            tabla += framework.name + '<br/>'
        tabla += '</td></tr>'
    tabla += '</table>'
    return HttpResponse(tabla)
