<?php
namespace backend\controllers;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); 



use Yii;
use app\models\Customers;
use app\models\CustomerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth; // to enable cors
use yii\filters\AccessControl;
use common\models\LoginForm;

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
            echo $customer->id;
        }
        else
        {
            echo 0;
        }
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
//public function behaviors()
//{
    // $behaviors = parent::behaviors();

    // // remove authentication filter
    // $auth = $behaviors['authenticator'];
    // unset($behaviors['authenticator']);

    // // add CORS filter
    // $behaviors['corsFilter'] = [
    //     'class' => \yii\filters\Cors::className(),
    // ];

    // // re-add authentication filter
    // $behaviors['authenticator'] = $auth;
    // // avoid authentication on CORS-pre-flight requests (HTTP OPTIONS method)
    // $behaviors['authenticator']['except'] = ['options'];

    // return $behaviors;
//}
// public function behaviors()
// {
//     return \yii\helpers\ArrayHelper::merge(
//         [
//             'cors' => [
//                 'class' => \yii\filters\Cors::className(),
//             ],
//         ],
//         parent::behaviors(),
//         [
//             'access' => [
//                 'class' => AccessControl::className(),
//                 'rules' => [
//                      ['allow' => true, 'actions' => ['options']],
//                 ]
//             ],
//         ]
//         );
// }

// public function behaviors()
// {
//     return [
//         'corsFilter' => [
//             'class' => \yii\filters\Cors::className(),
//             'cors' => [
//                 // restrict access to
//                 'Origin' => ['*'],
//                 // Allow only POST and PUT methods
//                 'Access-Control-Request-Method' => ['POST', 'PUT', 'OPTIONS'],
//                 // Allow only headers 'X-Wsse'
//                 'Access-Control-Request-Headers' => ['X-Wsse'],
//                 // Allow credentials (cookies, authorization headers, etc.) to be exposed to the browser
//                 'Access-Control-Allow-Credentials' => true,
//                 // Allow OPTIONS caching
//                 'Access-Control-Max-Age' => 3600,
//                 // Allow the X-Pagination-Current-Page header to be exposed to the browser.
//                 'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page'],
//             ],

//         ],
//     ];
// }

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


    public function actionSendnotification($api_tokens,$message)
    {
       
    }


}