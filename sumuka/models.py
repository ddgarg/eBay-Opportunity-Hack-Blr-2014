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

# Create in-memory database
app.config['SQLALCHEMY_DATABASE_URI'] = 'sqlite:///test.sqlite'
app.config['SQLALCHEMY_ECHO'] = True
db = SQLAlchemy(app)

# Figure out base upload path
base_path = op.join(op.dirname(__file__), 'static')

payment_type_enums = ('onetime','standing')


# Create models
class Child(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(20))
    address = db.Column(db.String(100))
    pic_path = db.Column(db.String(64))
    surgery_cost = db.Column(db.Float)
    donors = db.Column(db.String)


    def __init__(self, name, cost, **kwargs):
        self.name = name
        self.cost = cost
    def __repr__(self):
        return '<User %r>' % self.name

class Donor(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.Unicode(64))
    paid_amnt = db.Column(db.Float)
    payment_type = db.Column('type', db.Enum(payment_type_enums))
    email_id = db.Column(db.String(64))
    child = db.relation(Child, backref='sponsored_children')

    def __init__(self, name, donated_amnt, **kwargs):
        pass

class Receipt(db.Model):
    pass
class Subscription(db.Model):
    pass

def get_child_funds():
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
#
## This widget uses custom template for inline field list
#class CustomInlineFieldListWidget(RenderTemplateWidget):
#    def __init__(self):
#        super(CustomInlineFieldListWidget, self).__init__('field_list.html')
#
#
## This InlineModelFormList will use our custom widget
#class CustomInlineModelFormList(InlineModelFormList):
#    widget = CustomInlineFieldListWidget()
#
#
## Create custom InlineModelConverter and tell it to use our InlineModelFormList
#class CustomInlineModelConverter(InlineModelConverter):
#    inline_field_list_type = CustomInlineModelFormList
#
#
## Customized inline form handler
#class InlineModelForm(InlineFormAdmin):
#    form_excluded_columns = ('path',)
#
#    form_label = 'Image'
#
#    def __init__(self):
#        return super(InlineModelForm, self).__init__(ChildImage)
#
#    def postprocess_form(self, form_class):
#        form_class.upload = fields.FileField('Image')
#        return form_class
#
#    def on_model_change(self, form, model):
#        file_data = request.files.get(form.upload.name)
#
#        if file_data:
#            model.path = secure_filename(file_data.filename)
#            file_data.save(op.join(base_path, model.path))
#
#
## Administrative class
#class ChildAdmin(ModelView):
#    inline_model_form_converter = CustomInlineModelConverter
#
#    inline_models = (InlineModelForm(),)
#
#    def __init__(self):
#        super(ChildAdmin, self).__init__(Child, db.session, name='Childs')
#

# Simple page to show images
@app.route('/')
def index():
    locations = db.session.query(Child).all()
    return render_template('locations.html', locations=locations)


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
