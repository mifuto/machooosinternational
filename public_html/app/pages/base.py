from datetime import datetime
import os
import sys
import uuid

import json


from config import CONFIG
from database import DbConnector

class Base:
    def __init__(self):
        """
        @private
        """
        #print("DB in init fn")
        return
    
    def _list(self,sql):
        with DbConnector() as dbc:
            ret=dbc.query(f"{sql}")
        return ret
    
    def _get(self,sql):
        with DbConnector() as dbc:
            ret=dbc.query(f"{sql}")
        return ret
    
    def _update(self,table,where,data):
        with DbConnector() as dbc:
            ret=dbc.updateRecord(table,where,data)
        return ret
    
    def _create(self,table,data):
        with DbConnector() as dbc:
            ret=dbc.insertRecord(table,data)
        return ret
    
    def _count(self,sql,param):
        with DbConnector() as dbc:
            ct=dbc.getSingleResult(sql,param)
            return { "count": ct }