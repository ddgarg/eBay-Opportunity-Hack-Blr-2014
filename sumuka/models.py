import os
import os.path as op

from werkzeug import secure_filename
from sqlalchemy import event

from flask import Flask, request, render_template
from flask.ext.sqlalchemy import SQLAlchemy

from wtforms import fields

from flask.ext import admin
from flask.ext.admin.form import RenderTemplateWidget
from flask.ext.admin.model.form import InlineFormAdmin
from flask.ext.admin.contrib.sqla import ModelView
from flask.ext.admin.contrib.sqla.form import InlineModelConverter
from flask.ext.admin.contrib.sqla.fields import InlineModelFormList

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
base_path = op.join(op.dirname(__file__), 'static')

payment_type_enums = ('onetime','standing')

def get_user_attributes(cls):
    boring = dir(type('dummy', (object,), {}))
    return [item
            for item in inspect.getmembers(cls)
            if item[0] not in boring]
# Create models
class Child(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(20))
    address = db.Column(db.String(100))
    pic_path = db.Column(db.String(64))
    donors = db.Column(db.String(500))  # Json dump of list of donor ids. hoping 500 is enough
    surgeries = db.Column(db.String(500))  # Json dump of list of Surgery ids. hoping 500 is enough
    status = db.Column(db.String(20)) # Enum of progress

    def __init__(self, name, cost, status, **kwargs):
        self.name = name
        self.cost = cost
        self.status = status

    def __repr__(self):
        return '<User %r>' % self.name

class Donor(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.Unicode(64))
    donated_amnt = db.Column(db.Float, nullable=False)
    payment_type = db.Column(db.String(15),nullable=False)
    email_id = db.Column(db.String(64),nullable=False)
    phone = db.Column(db.String(20))

    def __init__(self, name, donated_amnt,email, p_type='onetime', **kwargs):
        assert p_type in payment_type_enums, "Wrong payment type sent"
        self.name  = name
        self.donated_amnt = donated_amnt
        self.payment_type = p_type
        self.email_id = email
        # From here http://stackoverflow.com/questions/6760536/python-iterating-through-constructors-arguments
        for each in kwargs.keys():
            if each in get_user_attributes():
                vars(self).update({each:kwargs.get(each)})


class Surgery(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    cost = db.Column(db.Float, nullable=False)
    deformity = db.Column(db.String(100))
    status = db.Column(db.String(30)) # Enum list of strings
    date = db.Column(db.Date)
    hospital = db.Column(db.String(50))

class Transactions(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    donor_id = db.Column('donor', db.Integer, db.ForeignKey('donor.id'), nullable=False)


class Receipt(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    paid = db.Column(db.Float, nullable=False) # Tobe auto populated
    donor = db.relationship('Donor',
                        backref=db.backref('donor',lazy='joined'), lazy='dynamic')

#class Subscription(db.Model):
#    pass

def get_child_funds(child_id):
    """
    Summarise how much funds have been donated to the child so far.

    """
    pass

## Register after_delete handler which will delete image file after model gets deleted
#@event.listens_for(ChildImage, 'after_delete')
#def _handle_image_delete(mapper, conn, target):
#    try:
#        if target.path:
#            os.remove(op.join(base_path, target.path))
#    except:
#        pass
#

# Simple page to show images
@app.route('/')
def index():
    locations = db.session.query(Child).all()
    return render_template('locations.html', locations=locations)

@app.route('/child')
def children():
    children = db.session.query(Child).all()

if __name__ == '__main__':
    # Create upload directory
    try:
        os.mkdir(base_path)
    except OSError:
        pass

    # Create admin
    admin = admin.Admin(app, name='Example: Inline Models')

    # Add views
    admin.add_view(ChildAdmin())

    # Create DB
    db.create_all()

    # Start app
    app.run(debug=True)
