<?php

use yii\helpers\Html;
?>

<style>
.navbar, .footer, .yii-debug-toolbar_position_bottom{display:none !important;}
.wrap > .container {
    padding: 0;
}
.success-page{
    max-width:300px;
    display:block;
    margin: 0 auto;
    text-align: center;
    position: relative;
    top: 50%;
    transform: perspective(1px) translateY(50%)
}

.text-success i {
    font-size: 40px;
}

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<div class="success-page">
    <h4 class="text-success"><i class="glyphicon glyphicon-ok-circle"></i><h4>
    <h2 class="text-success">Payment method added Successfully !</h2>
        <a onclick="loadVaults()" class="btn btn-success">Done</a>
    </div>
</div>

<script>
function loadVaults() {
    window.parent.loadVaults();
}
</script>
