from flask import Flask
from flask.ext.restful import reqparse
from flask.ext import restful
import json
from models import *
import logging

app  = Flask(__name__)

@app.route('/child', methods=['GET','POST','DELETE'])
@app.route('/child/<child_id>', methods=['GET','POST','DELETE'])
def child():
    if request.method == 'GET':
        import pdb; pdb.set_trace()
        if not request.args:
            allChildren = Child.query.all()
            return json.dumps(allChildren)
        else:
            Children = Child.query.filter_by(name=args.get('name'))
    if request.method == 'POST':
        import pdb; pdb.set_trace()
        # Decide create/update
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
    if request.method == 'DELETE':
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


if __name__ == '__main__':
    app.run(debug=True)

