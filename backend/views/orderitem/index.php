<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderItemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Order Items';
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['/order/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-items-index">

    <h1><?= Html::encode($this->title) ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= Html::a('Create Order Items', ['create', 'order_id' => $order_id], ['class' => 'btn btn-success pull-right']) ?>
    </h1>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'order_id',
            'title',
            'type',
            'quantity',
            // 'price',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
