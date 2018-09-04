<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "slots_pricing".
 *
 * @property string $id
 * @property string $time_from
 * @property string $time_to
 * @property string $type
 * @property string $price
 */
class SlotsPricing extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'slots_pricing';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['time_from', 'time_to', 'type', 'price'], 'required'],
            [['time_from', 'time_to', 'type', 'price'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'time_from' => 'Time From',
            'time_to' => 'Time To',
            'type' => 'Type',
            'price' => 'Price',
        ];
    }

    /**
     * @inheritdoc
     * @return SlotsPricingQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SlotspricingQuery(get_called_class());
    }
}
