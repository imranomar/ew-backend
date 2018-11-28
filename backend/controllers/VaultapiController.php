<?php
namespace backend\controllers;

header("Access-Control-Allow-Origin: *");

use app\models\Vault;
use Yii;
use yii\rest\ActiveController;
// to enable cors

class VaultapiController extends ActiveController
{
    public $modelClass = 'app\models\Vault';
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

    public function actionSetdefault($id)
    {
        $response = array("Success" => false, "Message" => "Invalid request.");

        $data = Yii::$app->request->post();
        if (Yii::$app->request->isPost && isset($data['customer_id']) && !empty($data['customer_id'])) {
            $customerId = $data['customer_id'];

            $myUpdate = "UPDATE vault SET as_default = 0 WHERE customer_id = " . $customerId;
            $result = Yii::$app->db->createCommand($myUpdate)->execute();

            $model = Vault::findOne($id);
            if ($model != null) {
                $model->as_default = 1;
                $model->save();
                $response = array("Success" => true, "Message" => "Mark as default successfully.");
            } else {
                $response = array("Success" => false, "Message" => "Vault not found");
            }
        }
        return $response;
    }

}
