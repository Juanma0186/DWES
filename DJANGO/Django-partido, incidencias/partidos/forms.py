from django import forms
from .models import Incidencia

class IncidenciaForm(forms.ModelForm):
  class Meta:
    model = Incidencia
    fields = '__all__' # Selecciona todos los campos, si solo queremos uno o varios ['titulo',...]
