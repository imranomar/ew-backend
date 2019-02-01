<?php

namespace app\models;

use Yii;

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
 */
class Addresses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'addresses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'city_id'], 'required'],
            [['customer_id', 'city_id', 'as_default'], 'integer'],
            [['street_name', 'pobox', 'unit_number'], 'string', 'max' => 75],
            [['floor'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_id' => 'Customer ID',
            'city_id' => 'City',
            'street_name' => 'Street Name',
            'pobox' => 'Pobox',
            'floor' => 'Floor',
            'unit_number' => 'Unit Number',
        ];
    }

    /**
     * @inheritdoc
     * @return AddressesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AddressesQuery(get_called_class());
    }

    public function extraFields() 
    {
        return [
            'customer'=>function($model){
                return $model->customer;
            },
            'city'=>function($model){
                return $model->city;
            }
        ];
    }


    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    public function getCity()
    {
        return $this->hasOne(Cities::className(), ['id' => 'city_id']);
    }
}
