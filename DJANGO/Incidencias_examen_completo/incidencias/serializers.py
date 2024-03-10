from rest_framework import serializers
from .models import Incidencia,Linea,Estacion


class LineaSerializer(serializers.ModelSerializer):
  class Meta:
    model = Linea
    fields = '__all__'
    
    
class EstacionSerializer(serializers.ModelSerializer):
  class Meta:
    model = Estacion
    fields = '__all__'
    
class IncidenciaSerializer(serializers.ModelSerializer):
  class Meta:
    model = Incidencia
    fields = '__all__'        