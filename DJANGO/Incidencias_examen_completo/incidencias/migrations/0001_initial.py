# Generated by Django 5.0.2 on 2024-02-29 02:02

import django.db.models.deletion
from django.db import migrations, models


class Migration(migrations.Migration):

    initial = True

    dependencies = [
    ]

    operations = [
        migrations.CreateModel(
            name='Estacion',
            fields=[
                ('id', models.BigAutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('nombre', models.TextField(max_length=50)),
            ],
        ),
        migrations.CreateModel(
            name='Linea',
            fields=[
                ('id', models.BigAutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('nombre', models.TextField(max_length=50)),
                ('color', models.TextField(max_length=50)),
                ('distancia', models.FloatField()),
            ],
        ),
        migrations.CreateModel(
            name='Incidencia',
            fields=[
                ('id', models.BigAutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('texto', models.TextField(max_length=50)),
                ('fecha', models.DateField(auto_now_add=True)),
                ('estacion', models.ForeignKey(on_delete=django.db.models.deletion.CASCADE, to='incidencias.estacion')),
            ],
        ),
        migrations.AddField(
            model_name='estacion',
            name='linea',
            field=models.ForeignKey(on_delete=django.db.models.deletion.CASCADE, to='incidencias.linea'),
        ),
    ]
