app.config(function($routeProvider,API_URL) {
    $routeProvider
    .when("/home", {
        templateUrl : API_URL + "home",
		controller : "home" 
    })
    .when("/dashboard", {
        templateUrl : API_URL + "dashboard",
		controller : "dashboard" 
    })
	.when("/login", {
        templateUrl : API_URL + "login",
		controller : "login" 
    })
	.when("/signup", {
        //templateUrl : API_URL + "login",
		controller : "signup" 
    })
	
    .when("/user/list", {
        templateUrl : API_URL + "user/list",
		controller : "userlist" 
    })
});