
<div class="modal-content modal-dialog-centered" >
    <div class="modal-header">
        <h4 class="modal-title">Коллекция</h4>
    </div>
    <div class="modal-body">
        <form>
        <input type="hidden" data-ng-model="collectionId" name="collectionId">
            <div class="form-group">
                <input type="text" data-ng-model="collectionName" name="collectionName" class="form-control">
            </div>
          
   
        
       
        </form>

                   
        <form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
            <label for="file">Загрузить из CSV</label>
            <input id="file" type="file" name="csv">
            <input  data-ng-model="collectionId2" name="colId" style="visibility: hidden; width:0em;" >
            <button class="btn btn-primary" >Загрузить</button>
        </form>

   


    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" data-ng-click="close()">Закрыть</button>
        <button type="button" class="btn btn-primary" data-ng-click="save()">Сохранить</button>

        <button type="button" class="btn btn-danger" data-ng-click="delete()">Удалить</button>
    </div>

     


</div>

