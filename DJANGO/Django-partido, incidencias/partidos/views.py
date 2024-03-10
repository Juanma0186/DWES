
from django.shortcuts import redirect, render
from django.views.generic import CreateView, ListView, UpdateView, DeleteView
from django.urls import reverse_lazy

from partidos.forms import IncidenciaForm
from .models import Equipo, Incidencia, Partido
# from .forms import PartidoForm, EquipoForm

# Create your views here.

class EquipoCreateView(CreateView):
  model = Equipo
  # form_class = EquipoForm
  fields = ['nombre']
  template_name = 'equipos/equipo_create.html'
  success_url = reverse_lazy('equipo_list')

class EquipoListView(ListView):
  model = Equipo
  context_object_name = "equipos"
  template_name = 'equipos/equipo_list.html'

  def get_queryset(self):
    return Equipo.objects.order_by('nombre')

class EquipoUpdateView(UpdateView):
  model = Equipo
  fields = '__all'
  template_name = 'equipos/equipo_update.html'
  success_url = reverse_lazy('equipo_list')

class EquipoDeleteView(DeleteView):
  model = Equipo
  context_object_name = "equipo"
  template_name = 'equipos/equipo_delete.html'
  success_url = reverse_lazy('equipo_list')


class PartidoCreateView(CreateView):
  model = Partido
  # form_class = PartidoForm
  fields = ['fecha', 'local', 'visitante', 'resultado_local', 'resultado_visitante']
  template_name = 'partidos/partido_create.html'
  success_url = reverse_lazy('partido_list')

class PartidoListView(ListView):
  model = Partido
  context_object_name = "partidos"
  template_name = 'partidos/partido_list.html'

  def get_queryset(self):
    return Partido.objects.order_by('fecha')

class PartidoUpdateView(UpdateView):
  model = Partido
  fields = ['fecha', 'local', 'visitante', 'resultado_local', 'resultado_visitante']
  template_name = 'partidos/partido_update.html'
  success_url = reverse_lazy('partido_list')

class PartidoDeleteView(DeleteView):
  model = Partido
  context_object_name = "partido"
  template_name = 'partidos/partido_delete.html'
  success_url = reverse_lazy('partido_list')

# Detalles

def detalle_partido(request, pk):
  partido = Partido.objects.get(id=pk)
  return render(request, 'partidos/partido_detalle.html', {'partido': partido})

def detalle_equipo(request, pk):
  equipo = Equipo.objects.get(id=pk)
  partidos = equipo.partidos_visitante.all()
  return render(request, 'equipos/equipo_detalle.html', {'equipo': equipo, 'partidos': partidos})

# Incidencias

def incidencias_view(request):
  if request.method == 'POST':
    form = IncidenciaForm(request.POST)
    if form.is_valid():
      form.save()
      return redirect('incidencias_list')
  form = IncidenciaForm()
  return render(request, 'incidencias/incidencias_form.html', {'form': form})

def incidencias_list(request):
  incidencias = Incidencia.objects.all()
  return render(request, 'incidencias/incidencias_list.html', {'incidencias': incidencias})

def incidencia_detail(request,pk):
  incidencia = Incidencia.objects.get(id=pk)
  return render(request, 'incidencias/incidencia_detail.html', {'incidencia': incidencia})
