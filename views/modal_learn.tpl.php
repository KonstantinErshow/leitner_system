
<div class="modal-content modal-dialog-centered" >
    <div class="modal-header">
        <h4 class="modal-title">Обучение</h4>
    </div>
    <div class="modal-body">
       
               <p>{{front}}</p>
                <p>{{back}}</p>


    </div>
          
     
  
       
        
   


    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" data-ng-click="close()">Закрыть</button>
        <button id="showanswer" class="btn btn-primary" data-ng-if="!NotHideButton&&showansBut" data-ng-click="show()"> Показать  ответ</button>


        <button type="button" class="btn btn-primary" id="good" data-ng-if="NotHideButton" data-ng-click="goodBut()"> Хорошо</button>
        <button type="button" class="btn btn-primary" id="easy" data-ng-if="NotHideButton" data-ng-click="easyBut()"> Легко</button>
        <button type="button" class="btn btn-primary" id="again" data-ng-if="NotHideButton"  data-ng-click="againBut()"> Снова</button>
    </div>

     


</div>

