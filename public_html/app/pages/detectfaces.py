"""
This example module shows various types of documentation available for use
with pydoc.  To generate HTML documentation for this module issue the
command:

    pydoc -w foo

"""
# controller1.py
import os
import sys
import uuid

import json

from config import CONFIG
from pages.response import Response
from pages.request import Request

from flask import Flask, jsonify, request 
from flask_restful import Resource, Api 

import hashlib

import random
import time
from datetime import datetime, timedelta
import base64


class DetectFaces(Resource):
  """
    User encapsulates a user entity in DB
    """
  def __init__(self):
    """
    @private
    """
    #print("DB in init fn")
    return

  def __enter__(self):
    """
    @private
    """
    return self
  
  def __exit__(self, exc_type, exc_value, traceback):
    """
    @private
    """
    return
  
  def get(self):
   resp = Response()
   user_data = request.json
   
   resp.setStatus(Response.SUCCESS)
   resp.setData('Inside get ')
   
   return resp.printJson()  
  
  # Corresponds to POST request
  def post(self):
    resp = Response()
    print('Inside')
    # user_data = request.json
    # email = user_data['email']
    print('Inside 1')

    resp.setStatus(Response.SUCCESS)
    resp.setData('Inside post ')
  

    return resp.printJson()  
        
