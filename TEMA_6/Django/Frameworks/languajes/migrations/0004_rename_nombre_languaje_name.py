# Generated by Django 5.0.1 on 2024-01-29 19:41

from django.db import migrations


class Migration(migrations.Migration):

    dependencies = [
        ('languajes', '0003_alter_framework_creationdate'),
    ]

    operations = [
        migrations.RenameField(
            model_name='languaje',
            old_name='nombre',
            new_name='name',
        ),
    ]
