<?php
namespace backend\controllers;

header("Access-Control-Allow-Origin: *");

use Yii;
use app\models\Orders;
use app\models\OrdersSearch;
use app\models\Tasks;
use yii\rest\ActiveController;
// to enable cors

class OrdersapiController extends ActiveController
{
    public $modelClass = 'app\models\Orders';
    public $enableCsrfValidation = false;

    public function actionTest()
    {
        echo 123;
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
            '*', // star allows all domains
            // 'http://test1.example.com',
            // 'http://test2.example.com',
        ];
    }

/**
 * @inheritdoc
 */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        // remove authentication filter
        $auth = $behaviors['authenticator'];
        unset($behaviors['authenticator']);

        // add CORS filter
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
        ];

        // re-add authentication filter
        $behaviors['authenticator'] = $auth;
        // avoid authentication on CORS-pre-flight requests (HTTP OPTIONS method)
        $behaviors['authenticator']['except'] = ['options'];

        return $behaviors;
    }

    public function actionCreateorder()
    {
        try
        {
            $response = array("Success" => false, "Message" => "Invalid request.");
            $data = Yii::$app->request->post();
            
            if (Yii::$app->request->isPost) {
                $model = new Orders();
                $data = Yii::$app->request->post();

                $model->customer_id = $data['customer_id'];
                $model->payment_id = $data['payment_id'];
                $model->status = $data['status'];
                $model->pickup_date = $data['pickup_date'];
                $model->pickup_at_door = $data['pickup_at_door'];
                $model->pickup_time_from = $data['pickup_time_from'];
                $model->pickup_time_to = $data['pickup_time_to'];
                $model->pickup_type = $data['pickup_type'];
                $model->pickup_price = $data['pickup_price'];
                $model->drop_date = $data['drop_date'];
                $model->drop_at_door = $data['drop_at_door'];
                $model->drop_time_from = $data['drop_time_from'];
                $model->drop_time_to = $data['drop_time_to'];
                $model->drop_type = $data['drop_type'];
                $model->drop_price = $data['drop_price'];
                $model->address_id = $data['address_id'];
                $model->same_day_pickup = $data['same_day_pickup'];
                $model->next_day_drop = $data['next_day_drop'];
                $model->comments = $data['comments'];

                if ($model->validate() && $model->save()) {
                    $pickup_task = new Tasks();
                    $pickup_task->order_id = $model->id;
                    $pickup_task->type = 1;
                    $pickup_task->status = 0;
                    $pickup_task->at = date('Y-m-d H:i:s');
                    $pickup_task->save();

                    $drop_task = new Tasks();
                    $drop_task->order_id = $model->id;
                    $drop_task->type = 2;
                    $drop_task->status = 0;
                    $drop_task->at = date('Y-m-d H:i:s');
                    $drop_task->save();

                    $response = array("Success" => true, "Message" => "Order created successfully");
                } else {
                    $response = array("Success" => false, "Message" => "Error while creating order");
                }
            }
        } 
        catch(Exception $exception) {
            $response = array("Success" => false, "Message" => $exception->message);
        }

        return $response;
    }

}
