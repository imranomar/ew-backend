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