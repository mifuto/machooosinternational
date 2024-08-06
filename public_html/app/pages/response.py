import os
import sys
import json

class Response:
    SUCCESS = 1
    ERROR = 0
    AUTH_FAILD = 2
    def __init__(self):
        """
        @private
        """
        self.__status=self.ERROR
        self.__data={}
        self.__error=""
        self.__sessDict={}
        return
    
    def setStatus(self,status):
        self.__status=status
    
    def getStatus(self):
        return self.__status
    
    def setData(self,data):
        self.__data=data

    def getData(self):
        self.__data
    
    def setSessionVar(self,key,val):
        self.__sessDict[key]=val


    def getSessionVar(self):
        self.__sessDict
    
    def printJson(self):
        resp = { 'status' : self.__status, 'data': self.__data, 'error': self.__error, 'sess': self.__sessDict}
        return json.dumps(resp,default=str)
        
