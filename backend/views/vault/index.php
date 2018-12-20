<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SlotsPricingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vault';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vault-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'customer_id',
            'number',
            'transact',
            'payment_type',
            'expiry_date',
            'expiry_month',
            'expiry_year',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {delete}',  // the default buttons + your custom button
            ]
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
