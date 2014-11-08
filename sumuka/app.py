from models import *
import json
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
