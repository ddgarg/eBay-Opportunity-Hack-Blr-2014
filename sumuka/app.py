from models import *

@app.route("/")
def index():
	return render_template("index.html")

@app.route("/donation")
def donation():
    return render_template("donation.html")


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
