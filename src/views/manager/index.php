<?php

use yii\helpers\Html;
use johnitvn\ajaxcrud\CrudAsset; 
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel johnitvn\settings\models\SettingsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Settings';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<div class="setting-index">
    <div id="ajaxCrudDatatable">
        <?php
                            return $this->render('_grid', [ 
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
                        
        ?>
    </div>
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
