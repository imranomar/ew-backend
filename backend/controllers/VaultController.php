<?php

namespace backend\controllers;

use Yii;
use app\models\Vault;
use app\models\VaultSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

// namespace backend\controllers;
// use Yii;
// use yii\web\Controller;
// use app\models\Vault;
// use app\models\VaultQuery;

// use yii\filters\VerbFilter;
// use yii\filters\AccessControl;


class VaultController extends Controller
{
    public function actionIndex()
    {

        $searchModel = new VaultSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
    * Displays a single Vault model.
    * @param string $id
    * @return mixed
    */
   public function actionView($id)
   {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

     /** 
    * Updates an existing Vault model. 
    * If update is successful, the browser will be redirected to the 'view' page. 
    * @param string $id 
    * @return mixed 
    */ 
   public function actionUpdate($id) 
   { 
       $model = $this->findModel($id); 
 
       if ($model->load(Yii::$app->request->post()) && $model->save()) { 
           return $this->redirect(['view', 'id' => $model->id]); 
       } else { 
           return $this->render('update', [ 
               'model' => $model, 
           ]); 
       } 
   } 
 
   /** 
    * Deletes an existing Vault model. 
    * If deletion is successful, the browser will be redirected to the 'index' page. 
    * @param string $id 
    * @return mixed 
    */ 
   public function actionDelete($id) 
   { 
       $this->findModel($id)->delete(); 
 
       return $this->redirect(['index']); 
   } 
 
   /** 
    * Finds the Vault model based on its primary key value. 
    * If the model is not found, a 404 HTTP exception will be thrown. 
    * @param string $id 
    * @return Vault the loaded model 
    * @throws NotFoundHttpException if the model cannot be found 
    */ 
   protected function findModel($id) 
   { 
       if (($model = Vault::findOne($id)) !== null) { 
           return $model; 
       } else { 
           throw new NotFoundHttpException('The requested page does not exist.'); 
       } 
   } 
 

    public function actionCreatevault()
    {

        //i validation and vertification ( if any )needed here.
        //page cannot be accessed directly
        //need https here ( if possible)

        $data = Yii::$app->request->post();

        if (Yii::$app->request->isGet) {
            $customer_id = $_GET['orderid'];
            $transact = $_GET['transact']; //used later for recurring payment
            $pay_type = $_GET['paytype']; //type of card indicator
            $card_no_mask = $_GET['cardnomask'];
            $exp_date = $_GET['cardexpdate'];

            $myUpdate = "UPDATE vault SET as_default = 0 WHERE customer_id = " . $customer_id;
            $result = Yii::$app->db->createCommand($myUpdate)->execute();

            $tmp_vault = new Vault();
            $tmp_vault->isNewRecord= true;
            $tmp_vault->customer_id = $customer_id;
            $tmp_vault->number = $card_no_mask;
            $tmp_vault->expiry_date = substr($exp_date,0,2);
            $tmp_vault->expiry_month = substr($exp_date,2,4);
            $tmp_vault->payment_type = $pay_type ;
            $tmp_vault->transact = $transact;
            $tmp_vault->as_default = 1;
            

            // $tmp_vault->customer_id = 9;
            // $tmp_vault->number = "0000000000009999";
            // $tmp_vault->expiry_date = 8;
            // $tmp_vault->expiry_month = 7;
            // if ($tmp_vault->validate()) {
            //     echo "validated";
            // } else {
            //     # code...
            //     echo "un-validated";
            // }
            

            if($tmp_vault->save())
            {
                echo "<img height='100%' width='100%' src='http://www.thisisbig.ae/advanced/backend/assets/down-icon.png'>";
            }
            else
            {
            
                echo "Not saving";
            }
            // echo "<BR>ERRORS>>>>><BR>";
            // print_r($tmp_vault->errors);
            // echo "<BR> END ERRORS>>>>><BR>";
        

            // echo "<pre>";
            // print_r($tmp_vault);
            // echo "</pre>";

            //todo: need to run javascript code only after document is loaded
            //note: cannot directly change document.location = "#/payment" -
        }
    }

    public function actionCreatevaultweb()
    {
        if (Yii::$app->request->isGet) {
            $customer_id = $_GET['orderid'];
            $transact = $_GET['transact']; //used later for recurring payment
            $pay_type = $_GET['paytype']; //type of card indicator
            $card_no_mask = $_GET['cardnomask'];
            $exp_date = $_GET['cardexpdate'];

            $myUpdate = "UPDATE vault SET as_default = 0 WHERE customer_id = " . $customer_id;
            $result = Yii::$app->db->createCommand($myUpdate)->execute();

            $tmp_vault = new Vault();
            $tmp_vault->isNewRecord= true;
            $tmp_vault->customer_id = $customer_id;
            $tmp_vault->number = $card_no_mask;
            $tmp_vault->expiry_date = substr($exp_date,0,2);
            $tmp_vault->expiry_month = substr($exp_date,2,4);
            $tmp_vault->payment_type = $pay_type ;
            $tmp_vault->transact = $transact;
            $tmp_vault->as_default = 1;
        

            if($tmp_vault->save()) {
                return $this->render('vault_success'); 
            } else {
                return $this->render('vault_error'); 
            }
        }
    }

}
