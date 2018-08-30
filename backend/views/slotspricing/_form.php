<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SlotsPricing */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="slots-pricing-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'time_from')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'time_to')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
