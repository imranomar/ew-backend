<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "customers".
 * 
 * @property string $id
 * @property string $full_name
 * @property string $email
 * @property string $facebook_id
 * @property string $password
 * @property string $phone
 * @property string $sex
 * @property string $api_token
 */
class Customers extends \yii\db\ActiveRecord {
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'customers';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'facebook_id'], 'integer'],
            [['full_name', 'email', 'phone', 'sex', 'api_token'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'full_name' => 'Full Name',
            'email' => 'Email',
            'facebook_id' => 'Facebook ID',
            'password' => 'Password',
            'phone' => 'Phone',
            'sex' => 'Sex',
            'api_token' => 'API Token'
        ];
    }

    public function getAddresses() {
        return $this->hasOne(Addresses::className(), ['customer_id' => 'id']);
    }
}
