import requests
from models import *
resources = ['/child','/donor']
url_params = {'/child/':{'name':'testchild'},
              '/donor':{'name':'testdonor'},
              }

def test_insert_record():
    db.engine.execute('use sumukha;')
    child_count_query = 'select count(*) from child;'
    donor_count_query = 'select count(*) from donor;'
    child_count_b4 = db.engine.execute(child_count_query).fetchall()
    for url in resources:
        url = "http://127.0.0.1:5000" + url
        requests.post(url, data=url_params.get(url))
    child_count_after = db.engine.execute(child_count_query)
    assert child_count_b4[0][0] +1 == child_count_after


if __name__ == '__main__':
    test_insert_record()
