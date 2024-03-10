from django.urls import path,include
from .views import LineaListView,IncidenciaCreateView,LineaDeleteView,LineaCreateView,EstacionCreateView,IncidenciaListView,LineaUpdateView
from . import views
from rest_framework import routers  

#!API_REST_FRAMEWORK
router=routers.DefaultRouter()

router.register('lineas',views.LineaViewSet)
router.register('estaciones',views.EstacionViewSet)
router.register('incidencias',views.IncidenciaViewSet)


app_name = 'incidencias'
urlpatterns = [
     path('listado/', LineaListView.as_view(),name='listado'),
     path('incidencia/nueva/<int:estacion_id>/', IncidenciaCreateView.as_view(),name='nueva_incidencia'),
     path('linea/nueva/', LineaCreateView.as_view(),name='nueva_linea'),
     path('estacion/nueva/', EstacionCreateView.as_view(),name='nueva_estacion'),
     path('incidencias/', IncidenciaListView.as_view(), name='incidencia_list'),
     path('update/<int:pk>/', LineaUpdateView.as_view(), name='update_linea'),
     path('pareja/<int:pk>/delete/', LineaDeleteView.as_view(), name='delete_linea'),
     path('api/',include(router.urls)),


]
