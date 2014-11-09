from django.db import models

class userDetail (models.Model):
    uname    = models.CharField (max_length = 20)
    password = models.CharField (max_length = 20)
    utype    = models.CharField (max_length = 3)
    # utype to role mapping:
    # 7: admin, 5: city head, 2:volenteer
    city     = models.CharField (max_length = 10)


class post (models.Model):
    post_id    = models.CharField (max_length = 10)
    uname    = models.CharField (max_length = 20) #author
    city    = models.CharField (max_length = 20)
    content    = models.CharField (max_length = 20)
    s1    = models.CharField (max_length = 20)
    s2    = models.CharField (max_length = 20)
    s3    = models.CharField (max_length = 20)
   

class comment (models.Model):
    comment_id = models.CharField (max_length = 10)
    post_id    = models.CharField (max_length = 10)
    uname    = models.CharField (max_length = 20) #author
    city    = models.CharField (max_length = 20)
    content    = models.CharField (max_length = 20)

class likes (models.Model):
    uname = models.CharField (max_length = 20)
    post_id = models.CharField (max_length = 10)


# Create your models here.

