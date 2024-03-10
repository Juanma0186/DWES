from apadrina.models import Pinguino
from django.views.generic import ListView, DetailView
from django.contrib.auth.views import LogoutView
from django.contrib.auth.mixins import LoginRequiredMixin

from rest_framework import permissions, viewsets
from .serializers import PinguinoSerializer

# Create your views here.
logout_view = LogoutView.as_view()

class Listado(ListView):
  model = Pinguino
  template_name = 'apadrina/listado.html'
  paginate_by = 2

class Detalle(LoginRequiredMixin,DetailView):
  model = Pinguino
  template_name = 'apadrina/detalle.html'

class PinguinoViewSet(viewsets.ModelViewSet):
  queryset = Pinguino.objects.all().order_by('nombre')
  serializer_class = PinguinoSerializer
  permission_classes = [permissions.IsAuthenticated]
