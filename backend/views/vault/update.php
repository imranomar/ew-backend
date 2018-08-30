<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Vault */

$this->title = 'Update Vault: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Vaults', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vault-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
