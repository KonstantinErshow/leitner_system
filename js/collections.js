var collections = angular.module('collections',['ui.bootstrap']); 
//контроллер модального окна  "modalWindowController"  

collections.controller('collectionsController', function($scope, $http, $uibModal) {

	$scope.open=function(id) {

		//запрос на получение информации 

		$http({

			method: "POST",
			url:"http://localhost/leitner_system/cabinet/cards/collections/getCollectionById",
			data: $.param({id:id}),
			headers: { 'Content-Type': 'application/x-www-form-urlencoded' }

		}).then(function(result){
		 
			if (result.data.success!=false) {

				$scope.collectionData = result.data;


				//из урла пришла инфа - открываем модальное окно

				var modalWindow = $uibModal.open({
	                animation: true,
	                controller: "modalWindowController",  //это контроллер модального окна 
	                templateUrl: '/leitner_system/views/modal.tpl.php',
	                backdrop: true,
	                resolve: {
	                    collectionData: function () {
	                        return $scope.collectionData;
	                    }
	                }



	            })
			}

		});





	}

	$scope.create = function(userId) {
 
		var modalWindow = $uibModal.open({
	                animation: true,
	                controller: "createModalWindowController",  //это контроллер модального окна 
	                templateUrl: '/leitner_system/views/create_modal.tpl.php',
	                backdrop: true,
	                resolve: {
	                	userId: function() {
	                		return userId;
	                	}
	                }
	               
	               
	            });
	}

});

 collections.config(['$qProvider', function ($qProvider) {   
             $qProvider.errorOnUnhandledRejections(false);
         }]);

collections.controller('modalWindowController', function ($scope, $http, $window, $uibModalInstance, collectionData) {

		
		 $scope.collectionId = collectionData.id;
		 $scope.collectionId2 = collectionData.id;
		 $scope.collectionName = collectionData.name;

		 $scope.save = function(){
		 	$http({
		 		method: "POST",
				url:"http://localhost/leitner_system/cabinet/cards/collections/saveCollection",
				data: $.param({id: $scope.collectionId, name: $scope.collectionName}),
				headers: { 'Content-Type': 'application/x-www-form-urlencoded' }

		 	}).then(function(result){

		 		alert(result.data.text);
		 		$uibModalInstance.close();
		 		$window.location.href="cabinet/collections";
		 	})


		 
		 }

		

		 


		 $scope.delete = function() {
		 	$http({
		 		method: "POST",
				url:"http://localhost/leitner_system/cabinet/cards/collections/deleteCollection",
				data: $.param({id: $scope.collectionId}),
				headers: { 'Content-Type': 'application/x-www-form-urlencoded' }

		 	}).then(function(result){

		 		alert(result.data.text);		 		
		 		$uibModalInstance.close();
		 		$window.location.href="cabinet/collections";
		 	})
		 }


		 $scope.close = function() {
		 	$uibModalInstance.dismiss('cancel');
		}


});

collections.controller('createModalWindowController', function ($scope, $http, $window, $uibModalInstance,userId) {

	$scope.save = function(){


	 $scope.collectionName = angular.element("#collectionName").val();

	 

	 $http({
		 		method: "POST",
				url:"http://localhost/leitner_system/cabinet/cards/collections/createCollection",
				data: $.param({userId:userId, name: $scope.collectionName}),
				headers: { 'Content-Type': 'application/x-www-form-urlencoded' }

		 	}).then(function(result){

		 		alert(result.data.text);
		 		$uibModalInstance.close();
		 		$window.location.href="cabinet/collections";
		 	})

	}
	

	 $scope.close = function() {
		 	$uibModalInstance.dismiss('cancel');
		}

});