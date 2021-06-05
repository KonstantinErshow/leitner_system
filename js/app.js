var app = angular.module ("cards", ["ngRoute"]);

app.config(function($routeProvider, $locationProvider){

	$routeProvider.when( "/:id", {templateUrl:"../../views/card.tpl.php"});
	$locationProvider.html5Mode(true);
	
});
//scope - связущее звено между моделью и контрллером
app.controller('cardsController', function($scope, $http, $window){  


	$scope.getInfoByCardId = function(id) {
		$http({
			method: "GET",
			url: "http://localhost/leitner_system/cabinet/cards/getCard", 
			params: {id:id}
		}).then(function(result){
			$scope.cardId = result.data.id;
			$scope.cardFrontSide = result.data.front_side;
			$scope.cardBackSide = result.data.back_side;
		})
	}

	$scope.saveCard = function() {
		$scope.cardFrontSide = angular.element("#cardFrontSide").val();
		$scope.cardBackSide = angular.element("#cardBackSide").val();
		
		$http({ method: "POST", 
			url: "http://localhost/leitner_system/cabinet/cards/saveCard",
			data: $.param({id:$scope.cardId, front_side:$scope.cardFrontSide, back_side: $scope.cardBackSide}),
			headers: {'Content-Type':'application/x-www-form-urlencoded'} 
			 }).then(function(result){
			 	if (result.data.success) {
			 		$window.location.href='leitner_system/cabinet/cards';
			 	}
			 })
			}
		

	$scope.deleteCard = function(id) {

		$http({ method: "POST", 
			url: "http://localhost/leitner_system/cabinet/cards/deleteCard",
			data: $.param({id: id}),
			headers: {'Content-Type':'application/x-www-form-urlencoded'} 
			 }).then(function(result){
			 	if (result.data.success) {
			 		$window.location.href='leitner_system/cabinet/cards';
			 	}
			 	else {
			 		alert ("Ошибка удаления карточки");
			 	}
			 })
	}
});