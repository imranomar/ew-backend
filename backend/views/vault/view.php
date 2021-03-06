<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Vault */

$this->title = 'Details';
$this->params['breadcrumbs'][] = ['label' => 'Vaults', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vault-view">

    <h1>
    <?= Html::encode($this->title) ?>

    <p class="pull-right">
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
            'name',
            'number',
            'transact',
            'payment_type',
            'expiry_date',
            'expiry_month',
            'expiry_year',
        ],
    ]) ?>

</div>
