import requests
import random
from models import *
resources = ['/child', '/donor', '/surgery', ] #'/transaction']
url_params = {'/child':{'name':'testchild' + str(random.choice(range(5))), 'cost':10000,},
              '/donor':{'name':'testdonor'+ str(random.choice(range(5))),'donated_amnt':2000},
              '/surgery':{'name':'testsurgery'+ str(random.choice(range(5))),},
#              '/transaction':{'name':'testtrxn'+ str(random.choice(range(5)))}
              }
hostname = "http://127.0.0.1:5000"
def test_insert_record():
    db.engine.execute('use sumukha;')
    child_count_query = 'select count(*) from child;'
    donor_count_query = 'select count(*) from donor;'
    child_count_b4 = db.engine.execute(child_count_query).fetchall()
    for url in resources:
        post_url = hostname + url
        r = requests.post(post_url, data=url_params.get(url))
    child_count_after = db.engine.execute(child_count_query)
    assert child_count_b4[0][0] +1 == child_count_after


if __name__ == '__main__':
    test_insert_record()
