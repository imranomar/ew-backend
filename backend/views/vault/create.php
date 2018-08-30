<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Vault */

$this->title = 'Create Vault';
$this->params['breadcrumbs'][] = ['label' => 'Vaults', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vault-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
