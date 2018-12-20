<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tasks */

$this->title = 'Update';
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['order\index']];
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index', 'order_id' => $model->order_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tasks-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
