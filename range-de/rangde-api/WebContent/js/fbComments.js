
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '299919686764461', // App ID
      channelUrl : 'https://localhost:8080/', // Channel File
      status     : true, // check login status
      cookie     : true, // enable cookies to allow the server to access the session
      xfbml      : true  // parse XFBML
    });
    
    
	FB.Event.subscribe('auth.authResponseChange', function(response) 
	{
 	 if (response.status === 'connected') 
  	{
  		//document.getElementById("message").innerHTML +=  "<br>Connected to Facebook";
  		//SUCCESS
  		
  		var input = document.createElement("input");

  	    input.setAttribute("type", "text");

  	    input.setAttribute("id", "fblog");
  	    

  	    input.setAttribute("value", "Connected");

  	    //append to form element that you want .
  	    document.getElementById("message").appendChild(input);
  		
  	}	 
	else if (response.status === 'not_authorized') 
    {
    	document.getElementById("message").innerHTML +=  "<br>Failed to Connect";

		//FAILED
    } else 
    {
    	document.getElementById("message").innerHTML +=  "<br>Logged Out";

    	//UNKNOWN ERROR
    }
	});	
	
    };
    
   	function Login()
	{
	
		FB.login(function(response) {
		   if (response.authResponse) 
		   {
		    	getUserInfo();
				
				
  			} else 
  			{
  	    	 console.log('User cancelled login or did not fully authorize.');
   			}
		 },{scope: 'email,user_photos,user_videos'});
	
	
	}

  function getUserInfo() {
	    FB.api('/me', function(response) {

	  var str="<b>Name</b> : "+response.name+"<br>";
	  	  str +="<b>Link: </b>"+response.link+"<br>";
	  	  str +="<b>Username:</b> "+response.username+"<br>";
	  	  str +="<b>id: </b>"+response.id+"<br>";
	  	  str +="<b>Email:</b> "+response.email+"<br>";
	  	  str +="<input type='button' value='Get Photo' onclick='getPhoto();'/>";
	  	  str +="<input type='button' value='Logout' onclick='Logout();'/>";
	  	  document.getElementById("message").innerHTML=str;
	  	  	postComment();    
	  	  //console.log('response.name.'+response.name);
    });
    }
  
  function getUserName(){
	    FB.api('/me', function(response) {

	  console.log(response.name);
	  
	   alert(response.name);
	   }); 
	    }
	
  function postComment(){

	  FB.api('/me/picture?type=normal', function(response) {

		  var str="<br/><b>Pic</b> : <img src='"+response.data.url+"'/>";
	  	  document.getElementById("status").innerHTML+=str;
	  	  	    
    });
 
 
  }
	function getPhoto()
	{
	  FB.api('/me/picture?type=normal', function(response) {

		  var str="<br/><b>Pic</b> : <img src='"+response.data.url+"'/>";
	  	  document.getElementById("status").innerHTML+=str;
	  	  	    
    });
	
	}
	function Logout()
	{
		FB.logout(function(){document.location.reload();});
	}

  // Load the SDK asynchronously
  (function(d){
     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/en_US/all.js";
     ref.parentNode.insertBefore(js, ref);
   }(document));


   function go() {
   
   
   FB.getLoginStatus(function(response) {
  if (response.status === 'connected') {
	  alert('auth')
    var uid = response.authResponse.userID;
	  alert(uid);
    var accessToken = response.authResponse.accessToken;
	
	var c1 = document.getElementById('area1').value;
	 alert(c1);
    var d1 = document.getElementById('as');
    d1.innerHTML = c1;
  
    console.log(uid);
    var input = document.createElement("input");

    input.setAttribute("type", "text");

    input.setAttribute("name", "fbid");

    input.setAttribute("value", uid);

    //append to form element that you want .
    document.getElementById("form1").appendChild(input);
	console.dir("user name is "+response.authResponse);
	console.log("token  "+accessToken);
	
  } else if (response.status === 'not_authorized') {
    // the user is logged in to Facebook, 
    // but has not authenticated your app
	
	alert('user is logged in but notauthenticated ');
  } else {
    alert('usernotauth');
	// the user isn't logged in to Facebook.
  }
 });
    
}
