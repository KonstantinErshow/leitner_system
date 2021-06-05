<div class="modal-content modal-dialog-centered" >
    <div class="modal-header">
        <h4 class="modal-title">Коллекция</h4>
    </div>
    <div class="modal-body">
        <form>
           
            <div class="form-group">
                <input type="text" id="collectionName" data-ng-model="collectionName" name="collectionName" class="form-control">
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" data-ng-click="close()">Закрыть</button>
        <button type="button" class="btn btn-primary" data-ng-click="save()">Создать</button>
    
    </div>
</div>