<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TasksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks';

$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['/order/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-index">

    <h1><?= Html::encode($this->title) ?>
        <?php if($order_id > 0): ?>
            <?= Html::a('Create Tasks', ['create', 'order_id' => $order_id], ['class' => 'btn btn-success pull-right']) ?>
        <?php endif; ?>
    </h1>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'order_id',
            'type',
            'at',
            'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
