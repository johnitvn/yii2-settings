<?php
use yii\helpers\Url;
use yii\widgets\Pjax;
use johnitvn\ajaxcrud\GridView;
use yii\helpers\Html;
use johnitvn\settings\controllers\ManagerController; 

/* @var $this yii\web\View */
/* @var $searchModel johnitvn\settings\models\SettingsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


?>


<?php

/**
* Grid toolbar config
*/
$createActionButton = Html::a('<i class="glyphicon glyphicon-plus"></i>',['create'],['data-modal-title'=>'Create new Settings','class'=>'create-action-button btn btn-default']);
$refreshActionButton = Html::a('<i class="glyphicon glyphicon-repeat"></i>',['index'],['data-pjax'=>1,'class'=>'btn btn-default']);
$fullScreenActionButton = Html::a('<i class="glyphicon glyphicon-resize-full"></i>','#',['class'=>'btn-toggle-fullscreen btn btn-default']);


$bulkDeleteButton = Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Delete All Selected',
                                 ["bulk-delete"] ,
                                 [
                                     "class"=>"btn-bulk-delete btn btn-danger",
                                     "data-method"=>"post",
                                     "title"=>"Delete All Selected",
                                     "data-confirm-message"=>"Are you sure to delete all this items?"
                                 ]);


/**
* Grid column config
*/
$gridColumns = [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'type',
        'filterType'=>GridView::FILTER_SELECT2,
        'filter'=>['string','integer','boolean','float'], 
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'section',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'key',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'value',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'active',
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'created',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'modified',
    // ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['class'=>'view-action-button','title'=>'View', 'data-toggle'=>'tooltip','data-modal-title'=>'View Settings'],
        'updateOptions'=>['class'=>'update-action-button','title'=>'Update', 'data-toggle'=>'tooltip','data-modal-title'=>'Update Settings'],
        'deleteOptions'=>['class'=>'delete-action-button','title'=>'Delete', 'data-toggle'=>'tooltip','data-confirm-message'=>'Are you sure to delete this item?'], 
    ],

];   

echo GridView::widget([
    'id'=>'crud-datatable',
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $gridColumns,
    'toolbar' =>  [['content'=> $createActionButton.$refreshActionButton.$fullScreenActionButton.'{toogleDataNoContainer}'],'{export}'],
    'bordered' => true,
    'striped' => true,
    'condensed' => true,
    'responsive' =>true,
    'responsiveWrap' => false,
    'hover' => false,
    'showPageSummary' => false,        
    'panel' => [
        'type' => 'primary', 
        'heading' => '<i class="glyphicon glyphicon glyphicon-list"></i>  Lists',
        'before' => '<em>* Resize table columns just like a spreadsheet by dragging the column edges.</em>',
        'after' =>  '<div class="pull-left"></div><div class="pull-right">'.$bulkDeleteButton.'</div><div class="clearfix"></div>',
        ],    

]);

?>

   
  
