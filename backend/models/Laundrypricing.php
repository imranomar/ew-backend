<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "laundry_pricing".
 *
 * @property string $id
 * @property string $title
 * @property string $type
 * @property string $price
 */
class Laundrypricing extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'laundry_pricing';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'type', 'price'], 'required'],
            [['price'], 'number'],
            [['title', 'type'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'type' => 'Type',
            'price' => 'Price',
        ];
    }

    /**
     * @inheritdoc
     * @return LaundrypricingQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LaundrypricingQuery(get_called_class());
    }
}
