from __future__ import unicode_literals

from django.db import models
from django.contrib.auth.models import User
from django.utils import timezone


class Patient(models.Model):
    # basic
    name = models.CharField(max_length=256)
    age = models.PositiveSmallIntegerField()
    gender = models.CharField(max_length=1)
    phone = models.CharField(max_length=32)

    # relation
    prescriptions = models.ManyToManyField('Prescription')

    def __str__(self):
        return self.name


class Doctor(User):
    # basic
    name = models.CharField(max_length=256)
    age = models.PositiveSmallIntegerField()
    gender = models.CharField(max_length=1)
    phone = models.CharField(max_length=32)
    specialty = models.CharField(max_length=1024, null=True)

    # relation
    prescriptions = models.ManyToManyField('Prescription')

    def __str__(self):
        return self.name


class Prescription(models.Model):
    # basic
    content = models.CharField(max_length=32768)
    date = models.DateTimeField()

    # relation
    doctor_id = models.ForeignKey('Doctor')
    patient_id = models.ForeignKey('Patient')
    symptoms = models.ManyToManyField('Symptom')
    diseases = models.ManyToManyField('Disease')
    medicine = models.ManyToManyField('Medicine')

    def __str__(self):
        return self.content

    def save(self, *args, **kwargs):
        if not self.id:
            self.date = timezone.now()
        self.date = timezone.now()
        super(Prescription, self).save(*args, **kwargs)


class Symptom(models.Model):
    # basic
    name = models.CharField(max_length=256)
    category = models.CharField(max_length=256)
    description = models.CharField(max_length=32768)

    # relation
    diseases = models.ManyToManyField('Disease')
    relate_medicine = models.ManyToManyField('Medicine')

    # extra
    causes = models.CharField(max_length=32768, null=True)

    def __str__(self):
        return self.name


class Disease(models.Model):
    # basic
    name = models.CharField(max_length=256)
    category = models.CharField(max_length=256)
    description = models.CharField(max_length=32768)

    # relation
    symptoms = models.ManyToManyField('Symptom')
    relate_medicine = models.ManyToManyField('Medicine')

    # extra
    causes = models.CharField(max_length=32768, null=True)
    management = models.CharField(max_length=32768, null=True)
    prevention = models.CharField(max_length=32768, null=True)
    mechanism = models.CharField(max_length=32768, null=True)
    epidemiology = models.CharField(max_length=32768, null=True)
    diagnosis = models.CharField(max_length=32768, null=True)
    prognosis = models.CharField(max_length=32768, null=True)

    def __str__(self):
        return self.name


class Medicine(models.Model):
    # basic
    name = models.CharField(max_length=256)
    category = models.CharField(max_length=256)
    description = models.CharField(max_length=32768)

    # relation
    diseases = models.ManyToManyField('Disease')
    symptoms = models.ManyToManyField('Symptom')
    incompatible_with = models.ManyToManyField('self')

    # extra
    properties = models.CharField(max_length=32768, null=True)
    adverse_effect = models.CharField(max_length=32768, null=True)
    mechanism = models.CharField(max_length=32768, null=True)
    pharmacokinetics = models.CharField(max_length=32768, null=True)

    def __str__(self):
        return self.name
