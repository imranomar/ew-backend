<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Cities;
/* @var $this yii\web\View */
/* @var $model app\models\Addresses */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="addresses-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'customer_id')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'street_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pobox')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'floor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unit_number')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <label>City</label>
        <?= Html::activeDropDownList($model, 'city_id',
        ArrayHelper::map(Cities::find()->all(), 'id', 'title'), [
            'class' => 'form-control'
        ]) ?>
    </div>

    <?= $form->field($model, "as_default")->checkbox(['value' => "1"]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
