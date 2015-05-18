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

wpa.directive('wpaSearchForm', function(){
	return {
		restrict: 'EA',
		template: 'Search Keyword: <input type="text" name="s" ng-model="filter.s" ng-change="search()">',
		controller: function ( $scope, $http ) {
			$scope.filter = {
				s: ''
			};
			$scope.search = function() {
				if ( $scope.filter.s.length >= 5 ) {
					$http.get('wp-json/posts/?filter[s]=' + $scope.filter.s).success(function(res){
						$scope.posts = res;
					});
				}
			};
		}
	};
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