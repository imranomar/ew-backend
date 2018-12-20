<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AddressesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Addresses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="addresses-index">

    <h1><?= Html::encode($this->title) ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= Html::a('Create Address', ['create'], ['class' => 'btn btn-success pull-right']) ?>
    </h1>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'customer_id',
            'city_id',
            'street_name',
            'pobox',
            // 'floor',
            // 'unit_number',
            'as_default',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
