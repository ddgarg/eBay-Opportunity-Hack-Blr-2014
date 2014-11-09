var app= angular.module('app',['ngRoute']);

/*app.service('loginService', ['$http', LoginObject]);

function LoginObject($http){

	
	
	
};*/

app.config(function($routeProvider){

	$routeProvider.
          when('/', {
            templateUrl: 'topic-list.html',
            controller: 'TopicListCtrl'
          }).
          when('/:topicName', {
            templateUrl: 'topic-detail.html',
            controller: 'TopicDetailCtrl'
          }).
		  when('/admin', {
            templateUrl: 'admin.html',
            controller: 'AdminCtrl'
          }).
          otherwise({
            redirectTo: '/'
          });
	
});

app.factory('topics', function($http){
        return {
          list: function(callback){
            $http.get('model/api.php?operation=getAllTopics').success(callback);
          }
        };
      });

app.controller('TopicListCtrl', function ($scope, topics){
        topics.list(function(topics) {
          $scope.topics = topics;
        });
      });
//signUpController , {params: [{u: userID}, {p: password}
app.controller('loginController', function($scope, $http){
$scope.login = function(){
	alert('hi');
	$scope.showBadLogin = "";
	var userID = $scope.username;
	var password = $scope.password;
	alert(userID);
	alert(password);
	$http.get('model/api.php?operation=auth&u=sudhansu&p=password').
	success(function(data, status, headers, config){
	
		if(data.toString() == 'true'){
		
			$scope.isValidUser = true;
			window.location.href = '/admin';
			
		}
		else{
			$scope.showBadLogin = true;
		};
		
	}).
	error(function(data, status, headers, config){
		
		
	});
	
};	
	
});

app.controller('signUpController', function($scope){
	
	$scope.signUp = function(){};
	
});