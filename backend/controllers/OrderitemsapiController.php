<?php
namespace backend\controllers;
header("Access-Control-Allow-Origin: *");


use Yii;
use app\models\Orders;
use app\models\Tasks;
use app\models\OrderItems;
use app\models\OrderItemsQuery;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth; // to enable cors
use yii\web\Response;


class OrderitemsapiController extends ActiveController
{
    public $modelClass = 'app\models\OrderItems';
    public $enableCsrfValidation = false;

    public function actionTest()
    {
        echo 123;
    }

    /**
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'create' page.
     * @return mixed
     */
    public function actionCreatemultiple()
    {
        try
        {   
            $data = array("Success"=> false, "Message" => "Invalid request");

            if (Yii::$app->request->isPost) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                $data = Yii::$app->request->post();
                
                if(!isset($data['task_id']) || $data['task_id'] <= 0) 
                {
                    $data = array("Success"=> false, "Message" => "Task id required");
                    return $data;
                }

                $task_id = $data['task_id'];

                if(!isset($data['order_id']) || $data['order_id'] <= 0) 
                {
                    $data = array("Success"=> false, "Message" => "Order id required");
                    return $data;
                }

                $order_id = $data['order_id'];

                if(!isset($data['order_items']) && count($data['order_items']) == 0) 
                {
                    $data = array("Success"=> false, "Message" => "No order items found.");
                    return $data;
                }

                $orderitems = $data['order_items'];

                foreach ($orderitems as $orderitem) {
                // echo '<pre>';print_r($orderitem);die;   
                    $item = new OrderItems();
                    $item->order_id = $orderitem["order_id"];
                    $item->title = $orderitem["title"];
                    $item->type = $orderitem["type"];
                    $item->quantity = $orderitem["quantity"];
                    $item->price = $orderitem["price"];
                    //echo '<pre>';print_r($item);die;
                    //Try to save the models. Validation is not needed as it's already been done.
                    $status = $item->save();
                }

                $model = Orders::findOne($order_id);
                if ($model != null) {
                    $model->pickup_close_id = $data['pickup_close_id'];
                    $model->pickup_close_other_id = $data['pickup_close_other_id'];
                    $model->pickup_close_comments = $data['pickup_close_comments'];
                    $model->status = $data['order_status'];
                    $model->save();

                    $taskModel = Tasks:: findOne($task_id);

                    if ($taskModel != null) {
                        $taskModel->status = $data['task_status'];
                        $taskModel->save();
                    } else {
                        $response = array("Success" => false, "Message" => "Task not found");
                        return $response;
                    }
                } else {
                    $response = array("Success" => false, "Message" => "Order not found");
                    return $response;
                }

                $data = array("Success"=> true, "Message" => "Order Items inserted successfully");
            }
        } catch(Exception $ex) {
            $data = array("Success"=> false, "Message" => $ex->message);
        }
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


}