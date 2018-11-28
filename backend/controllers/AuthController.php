<?php

namespace backend\controllers;

use Yii;
use app\models\Customers;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderController implements the CRUD actions for Orders model.
 */
class AuthController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Orders models.
     * @return mixed
     */
    public function actionReset($token)
    {   
        $this->layout = 'blank';

        $model = Customers::find()->where(['token'=>$token])->one();

        if($model === null) {
			throw new CHttpException(404,'The requested page does not exist.');
        }
       
        return  $this->render('reset', array(
            'model'=> $model
        ));
    }
}
