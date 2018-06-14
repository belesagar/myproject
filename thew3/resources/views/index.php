<!DOCTYPE html>
<html>
<head>
	<title>Test Angular</title>
	<script type="text/javascript" src="../angular/angular.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-route.js"></script>
</head>
<body ng-app="myApp" ng-controller="myCtrl">
	<div ng-view>
	byyyyy  -----<div>{{datastring}}</div> 
	
	</div>
	<a href="#!calltestangular">calltestangular</a>
<script src="../angular/myApp.js"></script>
<script src="../angular/route/route.js"></script>
<script src="../angular/controller/myController.js"></script>

</body>
</html>