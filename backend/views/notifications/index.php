<?php

use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $searchModel app\models\OptionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Notifications';
$this->params['breadcrumbs'][] = $this->title;
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<div class="options-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <form name="fcm_notification" id="fcmNotificationForm">
        <div class="form-group">
            <label for="subject">Sent To</label>
            <select class="form-control" id="sentTo" required onchange="ShowChildren(this)">
                <option value="all">All</option>
                <option value="user">User</option>
            </select>
        </div>

        <div class="form-group hide" data-child-sentTo="user">
            <label for="subject">Users</label>
            <select class="form-control" id="listOfUsers" required></select>
        </div>

        <div class="form-group">
            <label for="subject">Title</label>
            <input type="text" class="form-control" id="title" placeholder="Subject" required/>
        </div>

        <div class="form-group">
            <label for="contentMessage">Body Message</label>
            <textarea id="message" class="form-control" placeholder="Message" rows="5" required></textarea>
        </div>

        <button id="btnSend" type="button" class="btn btn-primary btn-lg" onclick="sendNotifications()">Send</button>
    </form>
</div>

<script>
    $(document).ready(function() {
        postJSON({}, _webAPIURL + 'customersapi/customerswithdevices', "Post", fillCustomerDropdownHandler, ErrorCallBack, true);
    });

    
    function fillCustomerDropdownHandler(jsonObj) {
        fillDropDown(jsonObj.Data, "listOfUsers", "id", "full_name");
    }

    function sendNotifications() {
        var check = false;
        var titleElement = $('#title');
        var messageElement = $('#message');
        var sentToElement = $('#sentTo');
        var userElement = $('#listOfUsers');

        check = validateField(titleElement);
        if(check == false) {
            showClientSideMessage('error', 'Please fill title');
            return check;
        }

        check = validateField(messageElement);
        if(check == false) {
            showClientSideMessage('error', 'Please write something in message');
            return check;
        }

        var data = {
            title: titleElement.val(),
            message: messageElement.val(),
            sent_to: sentToElement.val(),
            user_id: userElement.val()
        };
            
        postJSON(data, _webAPIURL + 'customersapi/sendnotification', "Post", sentNotificationsHandler, ErrorCallBack, true);
    }

    function sentNotificationsHandler(response) {
        if(response.Success == true) {
            showClientSideMessage('success', response.Message);
            $("#fcmNotificationForm")[0].reset();
            $('#sentTo').change();
        } else {
            showClientSideMessage('error', response.Message);
        }
    }
</script>
