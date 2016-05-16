from django.core.management.base import BaseCommand, CommandError
from prescription_maker.models import *
from datetime import datetime
from pytz import timezone
import random


class Command(BaseCommand):
    def handle(self, *args, **options):
        pass
