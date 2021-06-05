var learn = angular.module('learn',['ui.bootstrap']);

learn.controller('learningController', function($scope, $http, $uibModal){
	$scope.learn=function(id) {
	 	
		$http({

			method: "POST",
			url:"http://localhost/leitner_system/cabinet/learn/getCardsFromCollection",
			data: $.param({id:id}),
			headers: { 'Content-Type': 'application/x-www-form-urlencoded' }

		}).then(function(result){
		 
			if (result.data.success!=false) {

				$scope.learningData = result.data;

				

				//из урла пришла инфа - открываем модальное окно

				var modalWindow = $uibModal.open({
	                animation: true,
	                controller: "modalWindowController",  //это контроллер модального окна 
	                templateUrl: '/leitner_system/views/modal_learn.tpl.php',
	                backdrop: false,
	                resolve: {
	                    learningData: function () {
	                        return $scope.learningData;
	                    }
	                }



	            })
			}

		});

	}


});

learn.controller('modalWindowController', function ($scope, $http, $window, $uibModalInstance, learningData) {

	newCards = learningData['newCards'];
	goodCards = learningData['goodCards'];
	easyCards = learningData['easyCards'];

	newCards_id=[]
	goodCards_id=[]
	easyCards_id=[]

	goodCardsIdToSave=[]
	easyCardsIdToSave=[]
	learnedCardsIdToSave=[]

	for (id in newCards) {
		newCards_id.push(id);

	}

	for (id in goodCards) {
		goodCards_id.push(id);

	}

	for (id in easyCards) {
		goodCards_id.push(id);
	}

	$scope.showansBut=true;
	if (newCards_id.length>0) {
			currentCard = newCards_id.shift();
			$scope.currentCard = currentCard;
			$scope.front = learningData['newCards'][currentCard]['front_side']
			$scope.answer=learningData['newCards'][currentCard]['back_side'];
		}
		else if (goodCards_id.length>0){
			currentCard = goodCards_id.shift();
			$scope.currentCard = currentCard;
			$scope.front = learningData['goodCards'][currentCard]['front_side']
			$scope.answer=learningData['goodCards'][currentCard]['back_side'];
		}
		else if (easyCards_id.length>0){
			currentCard = easyCards_id.shift();
			$scope.currentCard = currentCard;
			$scope.front = learningData['easyCards'][currentCard]['front_side']
			$scope.answer=learningData['easyCards'][currentCard]['back_side'];
		}
		else {
			$scope.front ="Нет карточек для изучения на сегодня";
			$scope.showansBut=false;
		}

	$scope.show = function(){
		$scope.back=$scope.answer;
		$scope.NotHideButton=true;
	}

	$scope.againBut = function() {
		newCards_id.push(currentCard);
		$scope.NotHideButton = false;
		newQuestion();
	}

	$scope.goodBut = function() {
		goodCardsIdToSave.push(currentCard);
		$scope.NotHideButton = false;
		newQuestion();
	}

	$scope.easyBut = function() {
		
		if (easyCards_id.indexOf(currentCard)===-1)  {
			easyCardsIdToSave.push(currentCard);
		}
		else {
			learnedCardsIdToSave.push(currentCard);
		}


		$scope.NotHideButton = false;
		newQuestion();
	}

	newQuestion = function() {
		$scope.back='';
		if (newCards_id.length>0) {
			currentCard = newCards_id.shift();
			$scope.currentCard = currentCard;
			$scope.front = learningData['newCards'][currentCard]['front_side']
			$scope.answer=learningData['newCards'][currentCard]['back_side'];
		}
		else if (goodCards_id.length>0){
			currentCard = goodCards_id.shift();
			$scope.currentCard = currentCard;
			$scope.front = learningData['goodCards'][currentCard]['front_side']
			$scope.answer=learningData['goodCards'][currentCard]['back_side'];
		}
		else if (easyCards_id.length>0){
			currentCard = easyCards_id.shift();
			$scope.currentCard = currentCard;
			$scope.front = learningData['easyCards'][currentCard]['front_side']
			$scope.answer=learningData['easyCards'][currentCard]['back_side'];
		}
		else{			$scope.front ="Нет карточек для изучения на сегодня";
						$scope.showansBut=false;
		 }
	}

	$scope.close = function() {
		console.log(learnedCardsIdToSave);
		console.log(easyCardsIdToSave)
		console.log(goodCardsIdToSave);
		 
		$http({
		 		method: "POST",
				url:"http://localhost/leitner_system/cabinet/learn/saveCards",
				data: $.param({goodCards: goodCardsIdToSave, easyCards: easyCardsIdToSave, learnedCards: learnedCardsIdToSave}),
				headers: { 'Content-Type': 'application/x-www-form-urlencoded' }

		 	}).then(function(result){		 		 		
		 		$uibModalInstance.close();
		 		$window.location.href="cabinet/learn";
		 	});

	}


});

