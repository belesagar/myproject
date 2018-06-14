app.controller("myCtrl", function($scope,$http,API_URL) {
    $http.get(API_URL + "getdata").then(function (success){
		
		$scope.datastring = "This is responce.";
   });
}); 

app.controller("home", function($scope,$http,API_URL) {
   // $location.path("/calltestangular");
});

app.controller("login", function($scope,$http,API_URL) {
   // $location.path("/calltestangular");
});
app.controller("signup", function($scope,$http,API_URL) {
	alert("hiii");
   // $location.path("/calltestangular");
});

app.controller("dashboard", function($scope,$http,API_URL) {
   // $location.path("/calltestangular");
});


app.controller("userlist", function($scope,$http,API_URL) {
   // $location.path("/calltestangular");

   // $http({
			// url:API_URL+"/user/list",
			// method:"POST",
			//data:$scope.user,
		// }).success(function(response){
					// console.log(response);
	// });

});