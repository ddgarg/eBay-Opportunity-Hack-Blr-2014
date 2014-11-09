from django.template.loader import get_template
from django.template import Context
from django.http import HttpResponse
from django.shortcuts import render
from store.models import post
from store.models import comment
from django import forms
from django.core.mail import send_mail
from django import forms
from django.contrib.auth.forms import UserCreationForm
from django.http import HttpResponseRedirect
from django.contrib import auth
from django.views.decorators.csrf import csrf_exempt
from django.contrib.auth.models import User
import json

def calPostId():
	pid = 1
	allRows = post.objects.all()
	li = [1,2,3,4,5,6]
	l1 = []
	for row in allRows:
		l1.append(int(row.post_id))
	for i in range(0,7):
		if li[i] not in l1:
			pid = li[i]
	return pid 

def calCommentId():
        comment_id = 1
        allRows = comment.objects.all()
        for row in allRows:
                if int(row.comment_id) > comment_id:
			comment_id = int(row.comment_id)
	return comment_id + 1

def viewAddActivity(request):
	return render(request,"add_act.html")

@csrf_exempt
def viewAddActivityHandler(request):
	# create_activity?uname=u&city=c&content=content&s1=s1&s2=s2&s3=s3
	rowData = dict()
	for key in request.POST:
		rowData[key] =request.POST[key]
	print "ajha: normal stirng"
	pid = calPostId()
	row = post (post_id = str(pid) , uname = rowData["uname"], city = rowData["city"],
			content = rowData["content"], s1 = rowData["s1"],
 		  	s2 = rowData["s2"], s3 = rowData["s3"]);
	row.save()
	return HttpResponse ("Success")

def viewEditActivity(request):
	return render(request,"edit_act.html")

@csrf_exempt
def viewEditActivityHandler(request):
	# create_activity?pid=2&content=content
	rowData = dict()
	for key in request.POST:
		rowData[key] =request.POST[key]
	row = post.objects.filter(post_id = str(rowData["pid"]))
	row1 = post (post_id = row[0].post_id , uname = row[0].uname, city = row[0].city,
		content = str(rowData["content"]), s1 = row[0].s1,
		s2 = row[0].s2, s3 = row[0].s3);
	row[0].delete()
	row1.save()
	return HttpResponse ("Success")

def listActivity (request):
	#lists all Activities
	data = dict()
	allRows = post.objects.all()
	data["len"] = str(len(allRows))
	listData = []
	for row in allRows:
		rowData = dict()
		rowData["content"] = str(row.content)
		rowData["pid"] = str(row.post_id)
		listData.append(rowData)
	data["data"]=listData
	print data
	return HttpResponse (json.dumps(data), content_type='application/json')
	
def viewDeleteActivity(request):
	return render(request,"del_act.html")

@csrf_exempt
def viewDeleteActivityHandler(request):
	# create_activity?pid=2
	rowData = dict()
	for key in request.POST:
		rowData[key] =request.POST[key]
	row = post.objects.filter(post_id = str(rowData["pid"]))
	row[0].delete()
	return HttpResponse ("T")

def viewAddComment(request):
        return render(request,"add_comment.html")
@csrf_exempt
def viewAddCommentHandler(request):
        # create_activity?uname=u&city=c&content=content&s1=s1&s2=s2&s3=s3
        rowData = dict()
        for key in request.POST:
                rowData[key] =request.POST[key]
        cid = calCommentId()
        row = comment (comment_id = str(cid),post_id = rowData["postid"], uname = rowData["uname"], city = rowData["city"],
                        content = rowData["content"]);
        row.save()
        return HttpResponse ("Success")

def viewDeleteComment(request):
        return render(request,"del_comment.html")

@csrf_exempt
def viewDeleteCommentHandler(request):
        # create_activity?pid=2
        rowData = dict()
        for key in request.POST:
                rowData[key] =request.POST[key]
        row = comment.objects.filter(comment_id = str(rowData["comment_id"]))
        row[0].delete()
        return HttpResponse ("Success")

def signIn(request):
	return render(request,"sign_in.html")
@csrf_exempt
def signInHandler(request):
	# uname, password(pwd), role, city
	uname = request.POST.get('uname', '')
	pwd = request.POST.get('pwd', '')
	user = auth.authenticate (username= uname, password = pwd)
	m = User.objects.get(username = uname)
	if "member_id" in request.session:
		Id = request.session['member_id']
		m = User.objects.get(id = Id)
		print "user is", m.username
	else:
		request.session["member_id"] = m.id
	return HttpResponse ("Success Login")

def signUp(request):
	return render(request,"sign_up.html")

@csrf_exempt
def signUpHandler(request):
	uname = request.POST.get('uname', '')
	pwd = request.POST.get('pwd', '')
	user = User.objects.create_user(username = uname, password = pwd)
	
	user.is_staff = True
	user.save()
	return HttpResponse ("Success")

@csrf_exempt
def logout (request):
	try:
		del request.session['member_id']
	except KeyError:
		pass
	return HttpResponse ("Successfully logout")
@csrf_exempt
def login_status(request):
	   if "member_id" in request.session:
                Id = request.session['member_id']
                m = User.objects.get(id = Id)
                print "user is", m.username
	   return HttpResponse ("Success Login")
