<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "addresses".
 * 
 * @property string $id
 * @property string $customer_id
 * @property string $city_id
 * @property string $street_name
 * @property string $pobox
 * @property string $floor
 * @property string $unit_number
 * @property string $as_default
 */
class Addresses extends \yii\db\ActiveRecord {
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'addresses';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'customer_id', 'city_id', 'floor', 'as_default'], 'integer'],
            [['street_name', 'pobox', 'unit_number'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'customer_id' => 'Customer ID',
            'city_id' => 'City ID',
            'street_name' => 'Street Name',
            'pobox' => 'PO BOX',
            'floor' => 'Floor',
            'unit_number' => 'Unit Number',
            'as_default' => 'As Default'
        ];
    }
}
