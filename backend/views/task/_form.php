<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datetimepicker\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Tasks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tasks-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'order_id')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'type')->dropDownList(['1' => 'Pickup', '2' => 'Drop']) ?>
    
    <div class="form-group">
        <label>At</label>
        <?= DateTimePicker::widget([
            'model' => $model,
            'attribute' => 'at',
            'size' => 'ms',
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd hh:ii:ss',
                'todayBtn' => true
            ]
        ]);?>
    </div>

    <?= $form->field($model, 'status')->dropDownList(['0' => 'Pending', '1' => 'Done']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
