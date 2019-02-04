<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tasks".
 *
 * @property string $id
 * @property string $order_id
 * @property string $type
 * @property string $at
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'type', 'at', 'status'], 'required'],
            [['order_id', 'type', 'status'], 'integer'],
            [['at'], 'safe'],
        ];
    }

    public function extraFields() 
    {
        return [

            'order'=>function($model){
                return $model->order;
            },
            'vault'=>function($model){
                return $this->getVault($model->order->vault_id);
            },
            'payment'=>function($model){
                return $this->getPayment($model->order->payment_id);
            },
			'address'=>function($model){
                return $this->getAddress($model->order->address_id);
            },
            'customer'=>function($model){
                return $this->getCustomer($model->order->customer_id);
            }
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
            'type' => 'Type',
            'at' => 'At',
            'status' => 'Status'
        ];
    }

    /**
     * @inheritdoc
     * @return TasksQuery the active query used by this AR class.
     */
    public static function find()
    {
        //return new TasksQuery(get_called_class());
        if(isset($_GET['r']) && strpos($_GET['r'], 'api') == false) {
            return new TasksQuery(get_called_class());
        } else {
            return parent::find()->where(['status' => 0]);
        }
    }

    public function getOrder()
    {
        return $this->hasOne(Orders::className(), ['id' => 'order_id']);
    }
	
    public function getAddress($id)
    {
		$address= Addresses::find()->where (['id'=>$id])->one();
        return $address;
	}
	
	public function getCustomer($id){

    	$customer = Customers::find()->where(['id' => $id])->one();

    	return $customer;

    }

    public function getVault($id){
    	$vault = Vault::find()->where(['id' => $id])->one();
    	return $vault;
    }

    public function getPayment($id){
    	$Payment = Payments::find()->where(['id' => $id])->one();
    	return $Payment;
    }
}
