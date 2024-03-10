from django.urls import path, include
from .views import ListadoLineasEstaciones, CreateIncidencia

app_name = 'incidencias'
urlpatterns = [
  path('listado/', ListadoLineasEstaciones.as_view(), name='listado'),
  path('anadir/<int:linea_id>/<int:estacion_id>/', CreateIncidencia.as_view(), name='anadir'),

]
