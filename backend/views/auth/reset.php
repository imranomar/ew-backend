<?php 

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = 'Change Password';
?>

<div class="orders-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <strong>Hi! <?php echo $model->full_name;?>, Fill below fields to reset your password. </strong>

    <form name="reset_password" id="resetPasswordForm">
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Password" required/>
        </div>

        <div class="form-group">
            <label for="cpassword">Confirm Password</label>
            <input type="password" class="form-control" id="cpassword" placeholder="Confirm Password" required/>
        </div>

        <input type="hidden" id="token" value="<?php echo $model->token; ?>" />

        <button type="button" class="btn btn-primary" onclick="resetPassword()">Reset</button>
    </form>
</div>

<script>
function resetPassword() {
        var check = false;
        var password = $('#password');
        var cpassowrd = $('#cpassword');
        var token = $('#token');

        check = validateField(password);
        if(check == false) {
            showClientSideMessage('error', 'Please fill password');
            return check;
        }

        check = validateField(cpassowrd);
        if(check == false) {
            showClientSideMessage('error', 'Please fill confirm password');
            return check;
        }
        var passwordValue = password.val();
        var cpasswordValue = password.val();

        if(passwordValue.length < 6) {
            showClientSideMessage('error', 'Password should contains atleast 6 characters');
            return false;
        }

        if(passwordValue!= cpasswordValue) {
            showClientSideMessage('error', 'Password and confirm password are not same');
            return false;
        }

        var data = {
            password: passwordValue,
            cpassword: cpasswordValue,
            token: token.val()
        };
            
        postJSON(data, _webAPIURL + 'customersapi/resetpassword', "Post", resetPasswordHandler, ErrorCallBack, true);
    }

    function resetPasswordHandler(response) {
        if(response.Success == true) {
            showClientSideMessage('success', response.Message);
            $("#resetPasswordForm")[0].reset();
        } else {
            showClientSideMessage('error', response.Message);
        }
    }
</script>
