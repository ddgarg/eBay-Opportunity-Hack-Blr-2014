from models import *
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
