<?php

use yii\helpers\Html;
?>

<style>
.navbar, .footer, .yii-debug-toolbar_position_bottom{display:none !important;}
.wrap > .container {
    padding: 0;
}
.error-page{
    max-width:300px;
    display:block;
    margin: 0 auto;
    text-align: center;
    position: relative;
    top: 50%;
    transform: perspective(1px) translateY(50%)
}

.text-danger i {
    font-size: 40px;
}
    
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<div class="error-page">
    <h4 class="text-danger"><i class="glyphicon glyphicon-remove-cicle"></i><h4>
    <h2 class="text-danger">Payment Failure !! Click below button to try again</h2>
        <a onclick="closeModal()" class="btn btn-danger">Re-Process</a>
    </div>
</div>

<script>
function closeModal()
{
    $("#CloseDropTaskModal .modal-close", parent.document).trigger("click");
}
</script>
