# using flask_restful 
from flask import Flask, jsonify, request 
from flask_restful import Resource, Api 
from flask_cors import CORS

from pages.detectfaces import DetectFaces

# creating the flask app 
app = Flask(__name__) 
CORS(app, origins=['*'])

# CORS(app, origins=['https://machooosinternational.com'])

# creating an API object 
api = Api(app) 



# adding the defined resources along with their corresponding urls 
api.add_resource(DetectFaces, '/detectfaces') 

# driver function 
if __name__ == '__main__': 

	app.run(debug = True) 
