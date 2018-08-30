<?php


namespace backend\controllers;
use app\models\Vault;
use app\models\VaultQuery;

class VaultController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreatevault()
    {

        //i validation and vertification ( if any )needed here.
        //page cannot be accessed directly
        //need https here ( if possible)
        $customer_id = $_POST['orderid'];
        $transact = $_POST['transact']; //used later for recurring payment
        $pay_type = $_POST['paytype']; //type of card indicator
        $card_no_mask = $_POST['cardnomask'];
        $exp_date = $_POST['cardexpdate'];

        $tmp_vault = new Vault();
        $tmp_vault->isNewRecord= true;
        $tmp_vault->customer_id = $customer_id;
        $tmp_vault->number = $card_no_mask;
        $tmp_vault->expiry_date = substr($exp_date,0,2);
        $tmp_vault->expiry_month = substr($exp_date,2,4);
        $tmp_vault->payment_type = $pay_type ;
        $tmp_vault->transact = $transact;
        

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
            //echo  "saving";
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
