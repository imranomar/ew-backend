<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vault".
 *
 * @property string $id
 * @property string $customer_id
 * @property string $name
 * @property string $number
 * @property string $transact
 * @property string $payment_type
 * @property string $expiry_date
 * @property string $expiry_month
 * @property string $expiry_year
 */
class Vault extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vault';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'number', 'transact', 'payment_type', 'expiry_date', 'expiry_month'], 'required'],
            [['customer_id', 'expiry_date', 'expiry_month', 'expiry_year'], 'integer'],
            [['name'], 'string', 'max' => 200],
            [['number'], 'string', 'max' => 16],
            [['transact'], 'string', 'max' => 20],
            [['payment_type'], 'string', 'max' => 10],
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
            'name' => 'Name',
            'number' => 'Number',
            'transact' => 'the ticket used for recurring payments',
            'payment_type' => 'Payment Type',
            'expiry_date' => 'Expiry Date',
            'expiry_month' => 'Expiry Month',
            'expiry_year' => 'Expiry Year',
        ];
    }

    /**
     * @inheritdoc
     * @return VaultQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VaultQuery(get_called_class());
    }

    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }
}
