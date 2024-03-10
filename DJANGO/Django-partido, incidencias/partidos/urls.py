from django.urls import path

from partidos.views import EquipoCreateView, EquipoDeleteView, EquipoListView, EquipoUpdateView, PartidoCreateView, PartidoDeleteView, PartidoListView, PartidoUpdateView, detalle_partido, detalle_equipo, incidencia_detail, incidencias_list, incidencias_view

urlpatterns = [
  path('equipo/create', EquipoCreateView.as_view(), name="equipo_create"),
  path('equipo/list', EquipoListView.as_view(), name="equipo_list"),
  path('equipo/update/<int:pk>', EquipoUpdateView.as_view(), name="equipo_update"),
  path('equipo/delete/<int:pk>', EquipoDeleteView.as_view(), name="equipo_delete"),
  path('partido/create', PartidoCreateView.as_view(), name="partido_create"),
  path('partido/list', PartidoListView.as_view(), name="partido_list"),
  path('partido/update/<int:pk>', PartidoUpdateView.as_view(), name="partido_update"),
  path('partido/delete/<int:pk>', PartidoDeleteView.as_view(), name="partido_delete"),
  path('partido/detalle/<int:pk>', detalle_partido, name='detalle_partido'),
  path('partido/equipo/<int:pk>', detalle_equipo, name='detalle_equipo'),

  #Incidencias
  path('incidencias/crear/',incidencias_view, name="incidencias_view"),
  path('incidencias/list', incidencias_list, name="incidencias_list"),
  path('incidencias/detail/<int:pk>', incidencia_detail, name='incidencia_detail')
]
