from .models import Pinguino
from rest_framework import serializers

class PinguinoSerializer(serializers.ModelSerializer):
  class Meta:
    model = Pinguino
    fields = '__all__'
