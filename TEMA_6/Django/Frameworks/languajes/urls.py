from django.urls import path
from . import views

urlpatterns = [
    path('', views.languajes, name='languajes'), # Lo dejamos vacío para que sea la página principal
]
