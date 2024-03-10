from django.urls import path
from .views import ListadoParejas, DetallePersona

app_name = 'parejas'
urlpatterns = [
  path('listado', ListadoParejas.as_view(), name='listado'),
  path('detalle/<int:pk>', DetallePersona.as_view(), name='detalle'),
]
