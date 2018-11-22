<?php
namespace backend\controllers;


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); 



use Yii;
use app\models\Customers;
use app\models\CustomerSearch;
use app\models\CustomerDevices;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth; // to enable cors
use yii\filters\AccessControl;
use common\models\LoginForm;
use yii\web\Response;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use backend\assets\components\FirebaseHelper;

class CustomersapiController extends ActiveController
{
    public $modelClass = 'app\models\Customers';
    public $enableCsrfValidation = false;

    //returs id of customer if email and password is corrent
    public function actionAuthenticate($email, $password)
    {

        $customer = Customers::find()
        ->where(['email' => $email,'password'=> $password ])
        ->one();

        if($customer)
        {
            $customer_id = $customer->id;

            if(isset($_POST['device_id']) && !empty($_POST['device_id'])) {
                $device_id = $_POST['device_id'];
                if(!CustomerDevices::find()->where(['customer_id' => $customer_id, 'device_id'=> TRIM($device_id)])->exists()) {
                    $device = new CustomerDevices();
                    $device->customer_id = $customer_id;
                    $device->device_id = $device_id;
                    $device->save();
                }
            }

            echo $customer_id;
        }
        else
        {
            echo 0;
        }
    }

    public function actionCustomerswithdevices()
    {
        $data = array("Success"=> false, "Message" => "No order items found.");
        
        $listOfCustomers = Customers::find()
            ->innerJoinWith('customerDevices', false)
            ->select('customers.id, customers.full_name')
            ->orderBy(['customers.full_name' => 'ASC'])
            ->all();

        $data = array("Success"=> true, "Data" => $listOfCustomers);
        return $data;
    }


    /**
     * List of allowed domains.
     * Note: Restriction works only for AJAX (using CORS, is not secure).
     *
     * @return array List of domains, that can access to this API
     */
    public static function allowedDomains()
    {
        return [
            '*',                        // star allows all domains
            // 'http://test1.example.com',
            // 'http://test2.example.com',
        ];
    }

    protected function verbs()
    {
        return [
            'index' => ['GET', 'HEAD'],
            'view' => ['GET', 'HEAD'],
            'create' => ['PUT', 'POST','OPTIONS'],
            'update' => ['PUT', 'PATCH','OPTIONS'],
            'delete' => ['DELETE'],
        ];
    }


    public function actionSendnotification()
    {
        $data = array("Success"=> false, "Message" => "Invalid request method.");

        if ( Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();

            if(isset($data['sent_to']) && $data['sent_to'] == "all") {
                $d_ids = Customers::find()
                ->innerJoinWith('customerDevices', false)
                ->select('GROUP_CONCAT(DISTINCT customer_devices.device_id) as device_ids')
                ->asArray()
                ->one();
            } else {
                
                if(isset($data['user_id']) && $data['user_id'] > 0) {
                    $user_id = $data['user_id'];

                    $d_ids = Customers::find()
                            ->innerJoinWith('customerDevices', false)
                            ->select('DISTINCT GROUP_CONCAT(customer_devices.device_id) as device_ids')
                            ->where (['customers.id' => $user_id])
                            ->asArray()
                            ->one();
                } else {
                    $data = array("Success"=> false, "Message" => "User id not found.");
                    return $data;
                }
            }

            $device_ids = [];
            
            if(isset($d_ids['device_ids']) && !empty($d_ids['device_ids']))
                $device_ids = explode(',',$d_ids['device_ids']);

            if(COUNT($device_ids) == 0) {
                $data = array("Success"=> false, "Message" => "No devices ids found.");
                return $data;
            } 

            $notification_data = [
                "title" => $data['title'],
                "body" => $data['message']
            ];


            $result = array();
            $result = FirebaseHelper::sendPushNotification($device_ids, $notification_data);

            $data = array("Success"=> true, "Message" => "Notfication sent successfully");
        }

        return $data;
    }


}