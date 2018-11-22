<?php

namespace backend\assets\components;

use Yii;

class FirebaseHelper {
    
    // function makes curl request to firebase servers
    public static function sendPushNotification($divice_array, $notification) {
        
        // Set POST variables
        $url = 'https://fcm.googleapis.com/fcm/send';

        $headers = array(
            'Authorization: key=' . Yii::$app->params['firebase']['access_key'],
            'Content-Type: application/json'
        );

        $device_chunks = array_chunk($divice_array, 999);


        foreach($device_chunks AS $device_chunk){
            
            if(Count($device_chunk) == 1) {
                $fields = array(
                    'to' => $device_chunk[0],
                    'notification' => $notification
                );
            } else {
                $fields = array(
                    'registration_ids' => $device_chunk,
                    'notification' => $notification
                );
            }
        //echo '<pre>';print_r($fields);die;

            
            // Open connection
            $ch = curl_init();

            // Set the url, number of POST vars, POST data
            curl_setopt($ch, CURLOPT_URL, $url);

            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Disabling SSL Certificate support temporarly
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

            // Execute post
            $result = curl_exec($ch);
            // echo "Result".$result;
            if ($result === FALSE) {
                die('Curl failed: ' . curl_error($ch));
            }

            // Close connection
            curl_close($ch);
        }

        return $result;
    }
 }

?>