<?php
namespace backend\controllers;
header("Access-Control-Allow-Origin: *");


use Yii;
use app\models\Slotspricing;
use app\models\SlotspricingQuery;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth; // to enable cors

class SlotspricingapiController extends ActiveController
{
    public $modelClass = 'app\models\Slotspricing';
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
    // avoid authentication on CORS-pre-flight requests (HTTP Slotspricing method)
    $behaviors['authenticator']['except'] = ['Slotspricing'];

    return $behaviors;
}


}