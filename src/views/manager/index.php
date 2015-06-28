<?php

use yii\helpers\Html;
use yii\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel johnitvn\settings\models\SettingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Settings';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<div class="setting-index">
    <div id="ajaxCrudDatatable">
        <?php
Pjax::begin();
echo                 GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
            'columns' => [
                   ['class'=>'johnitvn\ajaxcrud\BulkColumn'],
                   ['class' => 'yii\grid\SerialColumn'],
            
                   // 'id',
           'type',
           'section',
           'key',
           'value:ntext',
           'active',
           // 'created',
           // 'modified',

                    ['class' => 'johnitvn\ajaxcrud\AjaxCrudActionColumn'],
                ],
            ]); 
                
Pjax::end() ;?>    </div>
    <div class="form-inline pull-left">
        <div class="checkbox">
            <label>
              <input id="select-all" type="checkbox"> Select All 
            </label>
        </div>        
        <button id="createNewModel" class="btn btn-sm btn-primary" data-url="<?=Url::to(["create"])?>"><span class="action-column glyphicon glyphicon-plus"></span>&nbsp;&nbsp;&nbsp;Add <?=$this->title?></button>
    </div>
    <button id="createNewModel" class="btn btn-sm btn-primary pull-right" data-url="<?=Url::to(["create"])?>"><span class="action-column glyphicon glyphicon-plus"></span>&nbsp;&nbsp;&nbsp;Add <?=$this->title?></button>   
</div>




<div id="ajaxCrubModal" class="fade modal" role="dialog" tabindex="-1">
<div class="modal-dialog ">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title"></h4>
</div>
<div class="modal-body">
    <p>Đang tải dữ liệu</p>
    <div class="overlay">
        <i class="fa fa-refresh fa-spin"></i>
    </div>   


</div>

</div>
</div>
</div>
