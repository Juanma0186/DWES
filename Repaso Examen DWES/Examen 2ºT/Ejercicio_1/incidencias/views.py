from django.shortcuts import render
from django.views.generic import ListView, CreateView
from .models import Estacion, Incidencia
# from django.urls import reverse_lazy

# Create your views here.

class ListadoLineasEstaciones(ListView):
  model = Estacion
  template_name = 'incidencias/listado.html'
  context_object_name = 'estaciones'

class CreateIncidencia(CreateView):
  model = Incidencia
  fields = ['texto', 'fecha']
  template_name = 'incidencias/anadir.html'
  context_object_name = 'estacion'

  #! FUMADA
  # def form_valid(self, form):
  #       linea_id = self.kwargs['linea_id']
  #       estacion_id = self.kwargs['estacion_id']
  #       incidencia = Incidencia.objects.create(
  #           texto=form.cleaned_data['texto'],
  #           fecha=form.cleaned_data['fecha'],
  #           estacion_id=estacion_id
  #       )

  #       # Agregar mensaje de éxito

  #       return super().form_valid(form)

  # def get_success_url(self):
  #       return reverse_lazy('tu_lista_de_incidencias')
