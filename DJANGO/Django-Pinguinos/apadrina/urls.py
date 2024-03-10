from django.urls import path, include
from .views import Listado, Detalle, logout_view, PinguinoViewSet

from rest_framework import routers

router = routers.DefaultRouter()
router.register(r'pinguinos', PinguinoViewSet, 'pinguinos')

app_name = 'apadrina'
urlpatterns = [
  path('', Listado.as_view(), name='index'),
  path('<int:pk>/', Detalle.as_view(), name='detalle'),
  path('logout/', logout_view, name='logout'),
  path('api/', include(router.urls)),
]
