<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\LaundryPricing;

/* @var $this yii\web\View */
/* @var $model app\models\OrderItems */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-items-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'order_id')->hiddenInput()->label(false); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    
    <div class="form-group">
        <label>Type</label>
        <?= Html::activeDropDownList($model, 'type',
        ArrayHelper::map(LaundryPricing::find()->all(), 'id', 'title'), [
            'class' => 'form-control'
        ]) ?>
    </div>

    <?= $form->field($model, 'quantity')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
