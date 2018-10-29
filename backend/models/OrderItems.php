<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_items".
 *
 * @property string $id
 * @property string $order_id
 * @property string $title
 * @property string $type
 * @property string $price
 */
class OrderItems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'title', 'type', 'price', 'quantity'], 'required'],
            [['order_id', 'quantity'], 'integer'],
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
            'order_id' => 'Order ID',
            'title' => 'Title',
            'type' => 'Type',
            'quantity' => 'Quantity',
            'price' => 'Price',
        ];
    }

    /**
     * @inheritdoc
     * @return OrderItemsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrderItemsQuery(get_called_class());
    }
}
