<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Laundrypricing */

$this->title = 'Create Laundrypricing';
$this->params['breadcrumbs'][] = ['label' => 'Laundrypricings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="laundrypricing-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
