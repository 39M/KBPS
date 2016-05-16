from django.conf import settings
from django.conf.urls import include, url
from django.contrib import auth
from django.http import HttpResponse
from django.shortcuts import render, redirect
from django.template import Context, RequestContext
from django.template.context_processors import csrf
from django.views.generic import *
from django.views.generic.edit import *
from datetime import datetime
from pytz import timezone
import os
import json


class Signup(View):
    pass


class Login(View):
    pass


class Logout(View):
    pass
