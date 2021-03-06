<?php
namespace backend\controllers;
header("Access-Control-Allow-Origin: *");


use Yii;
use yii\base\Model;
use app\models\Tasks;
use app\models\TasksQuery;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;
use yii\data\ActiveDataProvider;

class TasksapiController extends ActiveController
{
    public $modelClass = 'app\models\Tasks';
    public $enableCsrfValidation = false;

    public function actionTest()
    {
        echo 123;die;
    }


    public function actions() {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
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

    public function actionIndex() {
        $activeData = new ActiveDataProvider([
            'query' => Tasks::find(),
            'pagination' => false,
            'sort'=> ['defaultOrder' => ['status' => SORT_ASC]]
        ]);
        return $activeData;
    }

    public function actionCreatetasks() {
        $response = array("Success" => false, "Message" => "Invalid request.");
        $data = Yii::$app->request->post();
        if (Yii::$app->request->isPost && isset($data['order_id']) && !empty($data['order_id'])) {
            $pickup_task = new Tasks();
            $pickup_task->order_id = $data['order_id'];
            $pickup_task->type = 1;
            $pickup_task->status = 0;
            $pickup_task->at = date('Y-m-d H:i:s');
            $pickup_task->save();

            $drop_task = new Tasks();
            $drop_task->order_id = $data['order_id'];
            $drop_task->type = 2;
            $drop_task->status = 0;
            $drop_task->at = date('Y-m-d H:i:s');
            $drop_task->save();

            $response = array("Success" => true, "Message" => "Tasks created successfully.");
        }

        return $response;
    }


    
    public function actionGettodaytasks() {
        $query = Tasks::find()
        ->select('tasks.id, tasks.type, orders.id, orders.pickup_date, orders.drop_date, addresses.id, addresses.floor, addresses.street_name, cities.title as city')
        ->from('tasks')
        ->join('INNER JOIN', 'orders', 'orders.id = tasks.order_id')
        ->join('LEFT OUTER JOIN', 'addresses', 'addresses.id = orders.address_id')
        ->join('LEFT OUTER JOIN', 'cities', 'cities.id = addresses.city_id')
        ->Where(['tasks.type' => 1, 'orders.pickup_date' => date('Y-m-d')])
        ->orWhere(['tasks.type' => 2, 'orders.drop_date' => date('Y-m-d')])
        ->andWhere(['tasks.status'=> 0]);


        return $query->asArray()->all();
    }
}