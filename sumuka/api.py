from flask import Flask
from flask.ext import restful
import json
from models import *
import logging
app  = Flask(__name__)
api = restful.Api(app)
class ChildApi(restful.Resource):
    def get(self,**kwargs):
        allChildren = Child.query.all()
        return json.dumps(allChildren)

    def post(self,**kwargs):
        # Decide create/update
        child_exists = bool(Child.query.filter_by(name=kwargs.get('child_name')).all())
        if child_exists:
            oldChild = Child.query.filter_by(name=kwargs.get('child_name')).all()
            for k,v in kwargs:
                if k in utils.get_user_attributes(Child):
                    oldChild[k] = v
            db.session.add(oldChild)
            db.session.commit()
            # update
        else:
            # create request
            newChild = Child(kwargs.get('child_name'), kwargs.get('child_cost'), kwargs.get('child_status','new'))
            db.session.add(newChild)
            db.session.commit()
            return json.dumps({'id':newChild.id})

    def delete(self, **kwargs):
        children = Child.query.filter_by(name=kwargs.get('child_name')).all()
        assert len(children) == 1, logging.warn("Found multiple chiled records for one name ")
        for child in children:
            db.session.delete(child)
        db.session.commit()

class SurgeryApi(restful.Resource):
    def get(self):
        pass
    def post(self):
        pass
    def delete(self):
        pass

class TransactionsApi(restful.Resource):
    def get(self):
        pass
    def post(self):
        pass
    def delete(self):
        pass

class DonorApi(restful.Resource):
    def get(self):
        pass
    def post(self):
        pass
    def delete(self):
        pass

class HelloWorld(restful.Resource):
    def get(self):
        return {"hello": "world"}

class ImageApi(restful.Resource):
    def get(self, filename):
        return '/images/%s' % filename

api.add_resource(HelloWorld, '/')
api.add_resource(ChildApi, '/child')
api.add_resource(ImageApi, '/images')

if __name__ == '__main__':
    app.run(debug=True)

