import os
import sys
import json

class Request:
    
    def __init__(self,argsDict,sessDict):
        """
        @private
        """
        self.__argsDict=argsDict
        self.__sessDict=sessDict
        return
        
    def getArg(self,key):
        return self.__argsDict.get(key, "")
    
    def getSessionVar(self,key):
        return self.__sessDict.get(key, "")
    
    
