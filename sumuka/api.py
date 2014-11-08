from flask import Flask
from flask.ext.restful import reqparse
from flask.ext import restful
import json
from models import *
import logging

app  = Flask(__name__)
api = restful.Api(app)
class ChildApi(restful.Resource):
    def __init__(self):
        self.parser = reqparse.RequestParser()
        self.parser.add_argument('data',type=str, required=True)
        #for key in utils.get_user_attributes(Child):
        #    self.parser.add_argument(key, type=type(key), required=True)

    def get(self,args):
        allChildren = Child.query.all()
        return json.dumps(allChildren)

    def post(self):
        import pdb; pdb.set_trace()
        args = self.parser.parse_args()
        # Decide create/update
        print args.data
        child_exists = bool(Child.query.filter_by(name=args.get('name')).all())
        if child_exists:
            oldChild = Child.query.filter_by(name=args.get('name')).all()
            if request.files:
                # upload files
                bytestring = request.files.get('imgFile')[0].body
                img = Image.fromstring(bytestring)
                file_path = base_path+datetime.datetime.utctimenow().strftime("%d-%B-%Y-%H:%M")
                img.save(file_path)
                pic_paths = json.loads(oldChild.pic_paths)
                oldChild.pic_paths = pic_paths.append(file_path)
                oldChild.pic_paths = oldChild.pic_paths[-5:] # Max 5 images
            for k,v in args:
                if k in utils.get_user_attributes(Child):
                    oldChild[k] = v
            db.session.add(oldChild)
            db.session.commit()
            # update
        else:
            # create request
            newChild = Child(args.get('name'), args.get('cost'), args.get('status','new'))
            db.session.add(newChild)
            db.session.commit()
            return json.dumps({'id':newChild.id})

    def delete(self,):
        args = request.get_json()
        children = Child.query.filter_by(name=args.get('child_name')).all()
        assert len(children) == 1, logging.warn("Found multiple chiled records for one name ")
        for child in children:
            db.session.delete(child)
        db.session.commit()

class SurgeryApi(restful.Resource):
    def get(self):
        allSurgeries = Surgery.query.all()
        return json.dumps(allSurgeries)

    def post(self):
        pass
    def delete(self):
        pass

class TransactionsApi(restful.Resource):
    def get(self):
        allTransactions = Transactions.query.all()
        return json.dumps(allTransactions)

    def post(self):
        pass
    def delete(self):
        pass

class DonorApi(restful.Resource):
    def get(self):
        allDonors = Donor.query.all()
        return json.dumps(allDonors)
    def post(self):
        pass
    def delete(self):
        pass

class HelloWorld(restful.Resource):
    def get(self):
        return {"hello": "world"}

class ImageApi(restful.Resource):
    def get(self, filename):
        return '%s/%s' % (base_path, filename)

api.add_resource(HelloWorld, '/')
api.add_resource(ChildApi, '/child')
api.add_resource(ImageApi, '/images/<string:filename>')

if __name__ == '__main__':
    app.run(debug=True)

