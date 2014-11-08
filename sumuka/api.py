from flask import Flask
from flask.ext.restful import reqparse
from flask.ext import restful
import json
from models import *
import logging

app  = Flask(__name__)

@app.route("/")
def index():
    return render_template("index.html")

@app.route("/donation")
def donation():
    return render_template("donation.html")

@app.route("/donationDetails")
def donationDetails():
    email = request.form.get("email")
    phone = request.form.get("phone")
    details = {"name":"Rohan","amount":"1000","status":"Operated"}
    #details = json.loads(details)
    #TODO get the details from db and pass to donation details.html
    return render_template("donationdetails.html", details=details)

@app.route('/child', methods=['GET','POST','DELETE'])
@app.route('/child/<child_id>', methods=['GET','DELETE'])
def child(child_id=None):
    if request.method == 'GET':
        if not child_id:
            allChildren = Child.query.all()
            return json.dumps(allChildren)
        else:
            Children = Child.query.filter_by(id=child_id)
            return json.dumps(Children)

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
        if not child_id:
            logging.warn("Found multiple chiled records for one name ")
            return json.dumps({'status':'fail'})
        else:
            children = Child.query.filter_by(id=child_id).all()
            assert len(children) == 1, logging.warn("Found multiple chiled records for one name ")
            for child in children:
                db.session.delete(child)
            db.session.commit()
            return json.dumps({'status':'success'})

@app.route('/surgery', methods=['GET','POST','DELETE'])
@app.route('/surgery/<surg_id>', methods=['GET','DELETE'])
def SurgeryApi():
    if request.method == 'GET':
        if not surg_id:
            allSurgeries = Surgery.query.all()
            return json.dumps(allSurgeries)
        else:
            Surgeries = Surgery.query.filter_by(id=surg_id)
            return json.dumps(Surgeries)
    if request.method == 'POST':
        pass
    if request.method == 'DELETE':
        if not surg_id:
            logging.warn("Found multiple chiled records for one name ")
            return json.dumps({'status':'fail'})
        else:
            Surgeries = Surgery.query.filter_by(id=surg_id).all()
            assert len(Surgeries) == 1, logging.warn("Found multiple surgery records for one name ")
            for surg in Surgeries:
                db.session.delete(surg)
            db.session.commit()
            return json.dumps({'status':'success'})

@app.route('/transaction', methods=['GET','POST','DELETE'])
@app.route('/transaction/<trxn_id>', methods=['GET','DELETE'])
def Transactions():
    if request.method == 'GET':
        if not trxn_id:
            allTransactions = Transaction.query.all()
            return json.dumps(allTransactions)
        else:
            Transactions = Transaction.query.filter_by(id=trxn_id)
            return json.dumps(Transactions)
    if request.method == 'POST':
        pass

    if request.method == 'DELETE':
        if not trxn_id:
            logging.warn("Found multiple chiled records for one name ")
            return json.dumps({'status':'fail'})
        else:
            Transactions = Transaction.query.filter_by(id=trxn_id).all()
            assert len(Transactions) == 1, logging.warn("Found multiple surgery records for one name ")
            for trxn in Transactions:
                db.session.delete(trxn)
            db.session.commit()
            return json.dumps({'status':'success'})

@app.route('/transaction', methods=['GET','POST','DELETE'])
@app.route('/transaction/<trxn_id>', methods=['GET','DELETE'])
def Donors():
    if request.method == 'GET':
        if not trxn_id:
            allDonors = Donor.query.all()
            return json.dumps(allDonors)
        else:
            Donors = Donor.query.filter_by(id=trxn_id)
            return json.dumps(Donors)
    if request.method == 'POST':
        pass
    if request.method == 'DELETE':
        if not donor_id:
            logging.warn("Found multiple chiled records for one name ")
            return json.dumps({'status':'fail'})
        else:
            Donors = Donor.query.filter_by(id=donor_id).all()
            assert len(Donors) == 1, logging.warn("Found multiple surgery records for one name ")
            for donor in Donors:
                db.session.delete(donor)
            db.session.commit()
            return json.dumps({'status':'success'})

class HelloWorld(restful.Resource):
    def get(self):
        return {"hello": "world"}

class ImageApi(restful.Resource):
    def get(self, filename):
        return '%s/%s' % (base_path, filename)


if __name__ == '__main__':
    # Create upload directory
    try:
        os.mkdir(base_path)
    except OSError:
        pass

    # Create DB
    db.create_all()

    # Start app
    app.run(debug=True)

