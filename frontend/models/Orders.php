<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "orders".
 *
 * @property string $id
 * @property string $customer_id
 * @property string $payment_id
 * @property string $status
 * @property string $pickup_date
 * @property string $pickup_at_door
 * @property string $pickup_time_from
 * @property string $pickup_time_to
 * @property string $pickup_type
 * @property string $pickup_price
 * @property string $drop_date
 * @property string $drop_date
 * @property string $drop_at_door
 * @property string $drop_time_from
 * @property string $drop_time_to
 * @property string $drop_type
 * @property string $drop_price
 * @property string $address_id
 * @property string $same_day_pickup
 * @property string $next_day_drop
 * @property string $comments
 */
class Orders extends \yii\db\ActiveRecord {
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'customer_id', 'payment_id', 'status', 'pickup_at_door', 'pickup_time_from', 'pickup_time_to', 'pickup_type', 'pickup_price', 'drop_at_door', 'drop_time_from', 'drop_time_to', 'drop_type', 'drop_price', 'address_id', 'same_day_pickup', 'next_day_drop'], 'integer'],
            [['pickup_date', 'drop_date', 'comments'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'customer_id' => 'Customer ID',
            'payment_id' => 'Payment ID',
            'status' => 'Status',
            'pickup_date' => 'Pickup Date',
            'pickup_at_door' => 'Pickup At Door',
            'pickup_time_from' => 'Pickup Time From',
            'pickup_time_to' => 'Pickup Time To',
            'pickup_type' => 'Pickup Type',
            'pickup_price' => 'Pickup Price',
            'drop_date' => 'Drop Date',
            'drop_at_door' => 'Drop At Door',
            'drop_time_from' => 'Drop Time From',
            'drop_time_to' => 'Drop Time To',
            'drop_type' => 'Drop Type',
            'drop_price' => 'Drop Price',
            'address_id' => 'Address ID',
            'same_day_pickup' => 'Same Day Pickup',
            'next_day_drop' => 'Next Day Drop',
            'comments' => 'Comments',
        ];
    }

    public function getCustomers() {
        return $this->hasOne(Customers::className(), ['id' => 'customer_id']);
    }
}
