from flask import Flask
from flask.ext import restful
from models import *
app  = Flask(__name__)
api = restful.Api(app)
class ChildApi(restful.Resource):
    def get(self,**kwargs):
        pass
    def post(self,**kwargs):
        pass
    def delete(self, **kwargs):
        pass

class HelloWorld(restful.Resource):
    def get(self):
        return {"hello": "world"}

api.add_resource(HelloWorld, '/')

if __name__ == '__main__':
    app.run(debug=True)

