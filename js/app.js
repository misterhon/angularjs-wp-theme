var wpa = angular.module('wpa', ['ngRoute', 'ngSanitize']);

wpa.config( function( $routeProvider, $locationProvider ) {
	$locationProvider.html5Mode(true);
	
	$routeProvider
		.when('/', {
			templateUrl: localized.partials + 'main.html',
			controller: 'Main'
		})
		.when('/page/:slug', {
			templateUrl: localized.partials + 'post.html',
			controller: 'Page'
		})
		.when('/post/:slug', {
			templateUrl: localized.partials + 'post.html',
			controller: 'Post'
		});
});
	
wpa.controller('Main', ['$http', '$scope', function( $http, $scope ) {
	$http.get('/wp-json/posts/').success(function(res){
		$scope.posts = res;
	});
}]);

wpa.controller('Page', ['$http', '$scope', '$routeParams', function( $http, $scope, $routeParams ) {
	$http.get('/wp-json/pages/?filter[name]=' + $routeParams.slug).success(function(res){
		$scope.post = res[0];
	});
}]);

wpa.controller('Post', ['$http', '$scope', '$routeParams', function( $http, $scope, $routeParams ) {
	$http.get('/wp-json/posts/?filter[name]=' + $routeParams.slug).success(function(res){
		$scope.post = res[0];
	});
}]);