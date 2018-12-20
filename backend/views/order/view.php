<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */

$this->title = 'Details';
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-view">

    <h1><?= Html::encode($this->title) ?>

    <p class="pull-right">
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    </h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'customer_id',
            'payment_id',
            'status',
            'pickup_date',
            'pickup_at_door',
            'pickup_time_from',
            'pickup_time_to',
            'pickup_type',
            'pickup_price',
            'drop_date',
            'drop_at_door',
            'drop_time_from',
            'drop_time_to',
            'drop_type',
            'drop_price',
            'address_id',
            'same_day_pickup',
            'next_day_drop',
            'comments',
        ],
    ]) ?>


    
<div class="orders-index">

<h1>
    Order Items
    <?= Html::a('Create Items', ['orderitem/create', 'order_id' => $model->id], ['class' => 'btn btn-success pull-right']) ?>
</h1>

<?php Pjax::begin(); ?>    
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
        'price',

        [ 'class' => 'yii\grid\ActionColumn' ]
    ],
]); ?>
<?php Pjax::end(); ?>
</div>

</div>
