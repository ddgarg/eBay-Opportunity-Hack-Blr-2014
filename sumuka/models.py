import os

from werkzeug import secure_filename
from sqlalchemy import event

from flask import Flask, request, render_template
from flask.ext.sqlalchemy import SQLAlchemy

import utils
# Create application
app = Flask(__name__)

# Create dummy secrey key so we can use sessions
app.config['SECRET_KEY'] = '123456790'
DB_USERNAME = 'scott@localhost'
DB_PWD = 'tiger'
# Create in-memory database
app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql://%s:%s@localhost/sumukha'%(DB_USERNAME, DB_PWD)
#app.config['SQLALCHEMY_DATABASE_URI'] = 'postgresql://%s:%s@localhost/sumukha'%(DB_USERNAME, DB_PWD)
app.config['SQLALCHEMY_ECHO'] = True
db = SQLAlchemy(app)

# Figure out base upload path
base_path = os.path.join(os.path.dirname(__file__), 'static')

payment_type_enums = ('onetime','standing')
child_status_enums = ('new', 'in progress', 'finished')
# new -- no treat ment done
# in progress -- halfway through surgeries
trxn_status_enums = ('success', 'failure')
surg_status_enums = ('waiting', 'scheduled','finished')
# waiting -- waiting for funds
# scheduled -- date scheduled, funds accrued.

# Create models
class Child(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(20))
    address = db.Column(db.String(100))
    pic_paths = db.Column(db.String(500)) # Json dump of list of pic files. hoping to hell 500 is enough
    donors = db.Column(db.String(500))  # Json dump of list of donor ids. hoping 500 is enough
    surgeries = db.Column(db.String(500))  # Json dump of list of Surgery ids. hoping 500 is enough
    status = db.Column(db.String(20)) # Enum of progress

    def __init__(self, name=None, cost=0, status='new', **kwargs):
        self.name = name
        self.cost = cost
        self.status = status
        for each in kwargs.keys():
            if each in utils.get_user_attributes(Child):
                vars(self).update({each:kwargs.get(each)})
        assert self.status in child_status_enums

    def __repr__(self):
        return '<Child %r>' % self.name

class Donor(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.Unicode(64))
    donated_amnt = db.Column(db.Float, nullable=False)
    payment_type = db.Column(db.String(15),nullable=False)
    email_id = db.Column(db.String(64),nullable=False)
    phone = db.Column(db.String(20))

    def __repr__(self):
        return '<Donor %r>' % self.name

    def __init__(self, name=None, donated_amnt=0,email=None, p_type='onetime', **kwargs):
        self.name  = name
        self.donated_amnt = donated_amnt
        self.payment_type = p_type
        self.email_id = email
        # From here http://stackoverflow.com/questions/6760536/python-iterating-through-constructors-arguments
        for each in kwargs.keys():
            if each in utils.get_user_attributes(Donor):
                vars(self).update({each:kwargs.get(each)})
        assert self.payment_type in payment_type_enums, "Wrong payment type sent"

class Surgery(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    cost = db.Column(db.Float, nullable=False)
    name = db.Column(db.String(50))
    deformity = db.Column(db.String(100))
    status = db.Column(db.String(30)) # Enum list of strings
    date = db.Column(db.Date)
    hospital = db.Column(db.String(50))

    def __init__(self, name=None, deformity=None, cost=0, status='waiting', **kwargs):
        self.cost = cost
        self.name = name
        self.deformity = deformity
        self.status = status
        for each in kwargs.keys():
            if each in utils.get_user_attributes(Surgery):
                vars(self).update({each:kwargs.get(each)})
        assert self.status in surg_status_enums, 'Wrong surgical status given'

class Transactions(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    donor_id = db.Column('donor', db.Integer, db.ForeignKey('donor.id'), nullable=False)
    child_id = db.Column('child', db.Integer, db.ForeignKey('child.id'), nullable=False)
    donated_amnt = db.Column(db.Float, nullable=False)
    status = db.Column(db.String(20)) # Enum of transaction status

    def __init__(self, **kwargs):
        for each in kwargs.keys():
            if each in utils.get_user_attributes(Transactions):
                vars(self).update({each:kwargs.get(each)})
        assert self.status in trxn_status_enums, logging.warn('invalid transaction status')

#class Receipt(db.Model):
#    id = db.Column(db.Integer, primary_key=True)
#    paid = db.Column(db.Float, nullable=False) # Tobe auto populated
#    donor = db.relationship('Donor',
#                        backref=db.backref('donor',lazy='joined'), lazy='dynamic')


def get_child_funds(child_id):
    """
    Summarise how much funds have been donated to the child so far.

    """
    pass


