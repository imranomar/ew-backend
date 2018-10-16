<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "tasks".
 *
 * @property string $id
 * @property string $order_id
 * @property string $type
 * @property string $at
 * @property string $assigned_to
 */
class Tasks extends \yii\db\ActiveRecord {
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'tasks';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'type', 'assigned_to'], 'integer'],
            [['at', 'assigned_to'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'type' => 'Type',
            'at' => 'At',
            'assigned_to' => 'Assigned To'
        ];
    }

    public function getOrders() {
        return $this->hasOne(Orders::className(), ['id' => 'order_id']);
    }
}
