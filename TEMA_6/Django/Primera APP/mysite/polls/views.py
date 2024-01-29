from django.shortcuts import render

from django.http import HttpResponse

from .models import Question

def index(request):
    mi_html = [f"<p>{q.question_text}</p>"for q in Question.objects.all()]
    return HttpResponse(mi_html)
