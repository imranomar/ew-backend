<?php
namespace backend\controllers;
header("Access-Control-Allow-Origin: *");


use Yii;
use app\models\Orderitems;
use app\models\OrderitemsQuery;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth; // to enable cors
use yii\web\Response;


class OrderitemsapiController extends ActiveController
{
    public $modelClass = 'app\models\Orderitems';
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
        Yii::$app->response->format = Response::FORMAT_JSON;
        $orderitems = Yii::$app->request->post();
        
        $count = count($orderitems);

        if($count == 0) 
        {
            $data = array("Success"=> false, "Message" => "No order items found.");
            return $data;
        }


        foreach ($orderitems as $orderitem) {
           // echo '<pre>';print_r($orderitem);die;   
            $item = new Orderitems();
            $item->order_id = $orderitem["order_id"];
            $item->title = $orderitem["title"];
            $item->type = $orderitem["type"];
            $item->price = $orderitem["price"];
            //echo '<pre>';print_r($item);die;
            //Try to save the models. Validation is not needed as it's already been done.
            $status = $item->save();
        }

        $data = array("Success"=> true, "Message" => "Order Items inserted successfully");
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