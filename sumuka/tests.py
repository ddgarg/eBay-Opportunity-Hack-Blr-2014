import requests
resources = ['/child','/donor']
url_params = {'/child':{}, '/donor':{}}

def test_insert_record():
    child_count_query = ""
    donor_count_query = ""
    child_count_b4 = db.engine.execute(child_count_query)
    for url in resources:
        requests.post(url, url_params.get(url))

    assert child_count
