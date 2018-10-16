<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-view">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute'=>'Order Pickup Date',
                'value'=>$model->orders->pickup_date
            ],
            [
                'attribute'=>'Order Pickup Price',
                'value'=>$model->orders->pickup_price
            ],
            [
                'attribute'=>'Customer Full Name',
                'value'=>$model->orders->customers->full_name
            ],
            [
                'attribute'=>'Customer Email',
                'value'=>$model->orders->customers->email
            ],
            [
                'attribute'=>'Customer Facebook ID',
                'value'=>$model->orders->customers->facebook_id
            ],
            [
                'attribute'=>'Customer Phone',
                'value'=>$model->orders->customers->phone
            ],
            [
                'attribute'=>'Customer Address',
                'value'=>'PoBox:'.$model->orders->customers->addresses->pobox.', Floor: '.$model->orders->customers->addresses->floor.', Street: '.$model->orders->customers->addresses->street_name
            ],
            'type',
            'at',
            'assigned_to'
        ],
    ]) ?>

</div>
