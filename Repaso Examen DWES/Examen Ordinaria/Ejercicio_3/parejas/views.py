from django.shortcuts import render
from django.views.generic import ListView, DetailView
from .models import Pareja, Persona

# Create your views here.

class ListadoParejas(ListView):
  model = Pareja
  template_name = 'parejas/listado.html'
  context_object_name = 'parejas'

class DetallePersona(DetailView):
  model = Persona
  template_name = 'parejas/detalle.html'
  context_object_name = 'persona'

