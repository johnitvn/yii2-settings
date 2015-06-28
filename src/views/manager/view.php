<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model johnitvn\settings\models\Setting */
?>
<div class="setting-view">

  
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'type',
            'section',
            'key',
            'value:ntext',
            'active',
            'created',
            'modified',
        ],
    ]) ?>

</div>
