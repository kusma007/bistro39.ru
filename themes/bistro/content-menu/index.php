<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContentMenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Контент меню';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-menu-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать меню', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
//            'status',
            [
                'attribute' => 'Status',
                'format' => 'raw',
                'value' => function ($model) {
                    return '<button class="btn-on menu-'.$model->status.'" value="'.$model->status.'" onclick="sendAjax(this,\'content-menu\',\'swich-status\','.$model->id.')">'.$model->status.'</button>';
                },
            ],
            'content:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
