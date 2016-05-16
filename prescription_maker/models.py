from __future__ import unicode_literals

from django.db import models


class Patient(models.Model):
    # basic
    name = models.CharField(max_length=256)
    age = models.PositiveSmallIntegerField()
    gender = models.CharField(max_length=1)
    phone = models.CharField(max_length=32)

    # relation
    prescription = models.ManyToManyField(Prescription)


class Doctor(models.Model):
    # basic
    name = models.CharField(max_length=256)
    age = models.PositiveSmallIntegerField()
    gender = models.CharField(max_length=1)
    phone = models.CharField(max_length=32)
    specialty = models.CharField(max_length=1024)

    # relation
    prescription = models.ManyToManyField(Prescription)


class Prescription(models.Model):
    # basic
    content = models.CharField(max_length=32768)
    date = models.DateTimeField()

    # relation
    doctor = models.ForeignKey(Doctor)
    patient = models.ForeignKey(Patient)
    symptoms = models.ManyToManyField(Symptom)
    diseases = models.ManyToManyField(Disease)
    medicine = models.ManyToManyField(Medicine)


class Symptom(models.Model):
    # basic
    name = models.CharField(256)
    category = models.CharField(256)
    description = models.CharField(32768)

    # relation
    diseases = models.ManyToManyField(Disease)
    medicine = models.ManyToManyField(Medicine)

    # extra
    causes = models.CharField(32768)


class Disease(models.Model):
    # basic
    name = models.CharField(256)
    category = models.CharField(256)
    description = models.CharField(32768)

    # relation
    symptoms = models.ManyToManyField(Symptom)
    medicine = models.ManyToManyField(Medicine)

    # extra
    causes = models.CharField(max_length=32768)
    management = models.CharField(max_length=32768)
    prevention = models.CharField(max_length=32768)
    mechanism = models.CharField(max_length=32768)
    epidemiology = models.CharField(max_length=32768)
    diagnosis = models.CharField(max_length=32768)
    prognosis = models.CharField(max_length=32768)


class Medicine(models.Model):
    # basic
    name = models.CharField(256)
    category = models.CharField(256)
    description = models.CharField(32768)

    # relation
    diseases = models.ManyToManyField(Disease)
    symptoms = models.ManyToManyField(Symptom)
    incompatible_with = models.ManyToManyField("self")

    # extra
    property = models.CharField(max_length=32768)
    adverse_effect = models.CharField(max_length=32768)
    mechanism = models.CharField(max_length=32768)
    pharmacokinetics = models.CharField(max_length=32768)
