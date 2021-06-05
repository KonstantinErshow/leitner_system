<form class="form-horizontal" name="cardInfo" data-ng-submit="saveCard()">

	<input type="hidden" id="cardId" data-ng-model="cardId">
	<legend>Редактирование</legend>
	<div class="form-group">
		<label for="cardFrontSide" class="col-sm-3">Передняя часть карточки</label>
		<div class="col-sm-9">
			<textarea type="text" data-ng-model="cardFrontSide" id="cardFrontSide" class="form-control"></textarea>
		</div>
	</div>

	<div class="form-group">
		<label for="cardBackSide" class="col-sm-3">Задняя часть карточки</label>
		<div class="col-sm-9">
			<textarea type="text" data-ng-model="cardBackSide" id="cardBackSide" class="form-control"></textarea>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-9">
			<button class="btn btn-primary">Сохранить</button>
			<button class="btn btn-danger" type="button" data-ng-click="deleteCard(cardId)">Удалить</button>
		</div>
	</div>
</form>