from django import forms
from .models import Linea

class LineaForm(forms.ModelForm):
    nombre = forms.CharField(max_length=200, required=True)
    color = forms.CharField(max_length=200, required=True)
    distancia = forms.FloatField(required=True)

    class Meta:
        model = Linea
        fields = ['nombre', 'color', 'distancia']
