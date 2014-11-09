from django.conf.urls import patterns, include, url
from django.contrib import admin

urlpatterns = patterns('',
    # Examples:
    # url(r'^$', 'server.views.home', name='home'),
    # url(r'^blog/', include('blog.urls')),
    url(r'^viewadd_activity$', 'server.views.viewAddActivity', name='viewAddActivity'),
    url(r'^add_activity$', 'server.views.viewAddActivityHandler', name='AddActivity'),
    url(r'^viewedit_activity$', 'server.views.viewEditActivity', name='viewEditActivity'),
    url(r'^edit_activity$', 'server.views.viewEditActivityHandler', name='EditActivity'),
    url(r'^viewdel_activity$', 'server.views.viewDeleteActivity', name='viewDeleteActivity'),
    url(r'^del_activity$', 'server.views.viewDeleteActivityHandler', name='DelteActivity'),
    url(r'^viewadd_comment$', 'server.views.viewAddComment', name='viewAddComment'),
    url(r'^add_comment$', 'server.views.viewAddCommentHandler', name='CommentHandler'),
    url(r'^viewdel_comment$', 'server.views.viewDeleteComment', name='viewDeleteComment'),
    url(r'^del_comment$', 'server.views.viewDeleteCommentHandler', name='DeleteComment'),
    url(r'^list_act$', 'server.views.listActivity', name='listActivity'),
    url(r'^signup_form$', 'server.views.signUp', name='sup'),
    url(r'^signup$', 'server.views.signUpHandler', name='suph'),
    url(r'^signin_form$', 'server.views.signIn', name='sip'),
    url(r'^signin$', 'server.views.signInHandler', name='siph'),
    url(r'^logout$', 'server.views.logout', name='lo'),
    url(r'^stat$', 'server.views.login_status', name='ls'),
    url(r'^admin/', include(admin.site.urls)),
)
