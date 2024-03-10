from django import forms
from django.utils import timezone
from django.contrib import messages
from django.urls import reverse
from django.views.generic import ListView,CreateView,UpdateView,DeleteView
from .models import Linea,Estacion,Incidencia
from .forms import  LineaForm
from django.contrib.auth.decorators import login_required
from django.contrib.auth.mixins import LoginRequiredMixin


#!API_REST_FRAMEWORK
from rest_framework import viewsets
from .serializers import LineaSerializer,EstacionSerializer,IncidenciaSerializer
from rest_framework.authentication import TokenAuthentication
from rest_framework.permissions import IsAuthenticated


# Create your views here.

class LineaListView(LoginRequiredMixin,ListView):
    model=Linea
    template_name = 'listaLinea.html'
    context_object_name= 'lineas'


#! Esta clase y la de arriba hacen lo mismo pero desde diferente modelo
# class LineaListView(ListView):
#     model = Estacion
#     template_name = 'listaLinea.html'
#     context_object_name = 'estaciones'

    
class IncidenciaListView(LoginRequiredMixin,ListView):
    model=Incidencia
    template_name = 'incidencia_list.html'
    context_object_name= 'incidencias'
    
    
    
# class LineaCreateView(CreateView):
#     model= Linea
#     template_name='linea_form.html'
#     fields= '__all__'
#     success_url= '/listado/'
    
#     def form_valid(self, form):
#         response = super().form_valid(form)
#         messages.success(self.request, "La línea ha sido creada con éxito.")
#         return response

#     def get_success_url(self):
#         return reverse('incidencias:listado')
    
#! Más fácil que la de arriba para mandar mensaje de exito (hay que crear el forms.py)    
class LineaCreateView(CreateView):
    form_class = LineaForm
    template_name = 'linea_form.html'
    success_url = '/listado/'

    def form_valid(self, form):
        response = super().form_valid(form)
        messages.success(self.request, "La línea ha sido creada con éxito.")
        return response    

class EstacionCreateView(CreateView):
    model=Estacion
    template_name='estacion_form.html'
    fields= '__all__'
    success_url = '/listado/'

    def form_valid(self, form):
        response = super().form_valid(form)
        messages.success(self.request, "La estación ha sido creada con éxito.")
        return response
    
    
class IncidenciaCreateView(CreateView):
    model = Incidencia
    # fields = ['texto']
    fields = ['texto', 'estacion', 'fecha']
    template_name = 'incidencia_form.html'

    #!Esta forma es para cuando se hace el create sin enviar nada por la url 
    # def form_valid(self, form):
    #     response = super().form_valid(form)
    #     messages.success(self.request, "La incidencia ha sido creada con éxito.")
    #     return response
    
    # #!Hacer el input fecha como type date
    # def get_form(self, form_class=None):
    #     form = super().get_form(form_class)
    #     form.fields['fecha'].widget = forms.DateInput(attrs={'type': 'date'})
    #     return form
    
    #!Esta forma es para cuando se hace el create enviando el id por la url 
    def form_valid(self, form):
        estacion_id = self.kwargs.get('estacion_id')
        if estacion_id:
            form.instance.estacion = Estacion.objects.get(id=estacion_id)
        form.instance.fecha = timezone.now()
        return super().form_valid(form)

    def get_success_url(self):
        messages.success(self.request, "Su incidencia ha sido dada de alta.")
        return reverse('incidencias:incidencia_list')
    
    
class LineaUpdateView(UpdateView):
    model= Linea
    template_name='linea_form.html'
    fields= '__all__'
    success_url= '/listado/'
    
    def form_valid(self, form):
        response = super().form_valid(form)
        messages.success(self.request, "La línea ha sido actualizada con éxito.")
        return response    
    
class LineaDeleteView(DeleteView):
    model= Linea
    template_name='linea_confirm_delete.html'
    success_url= '/listado/'
    
    def delete(self, request, *args, **kwargs):
        response = super().delete(request, *args, **kwargs)
        messages.success(self.request, "La línea ha sido eliminada con éxito.")
        return response    
    
    
#! PARTE DE LA API_REST_FRAMEWORK

class LineaViewSet(viewsets.ModelViewSet):
    queryset = Linea.objects.all()
    serializer_class = LineaSerializer
    authentication_classes = [TokenAuthentication]
    permission_classes = [IsAuthenticated]
    
class EstacionViewSet(viewsets.ModelViewSet):
    queryset = Estacion.objects.all()
    serializer_class = EstacionSerializer
    
class IncidenciaViewSet(viewsets.ModelViewSet):
    queryset = Incidencia.objects.all()
    serializer_class = IncidenciaSerializer
   
    