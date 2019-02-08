<?php

use yii\helpers\Html;
?>

<!-- <style>
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
</div> -->
<style>
    
    .loader-container {
    width: 100%;
    height: 100%;
    position: fixed;
    z-index: 1000001;
    top: 0;
    background: #fff;
    left: 0;
}
  
  .loader {
    position: absolute;
    left: calc(50% - 40px);
    top: calc(50% - 40px);
    z-index: 1;
    width: 60px;
    height: 60px;
    border: 5px solid #f3f3f3;
    border-radius: 50%;
    border-top: 5px solid #3498db;
    -webkit-animation: spin .8s linear infinite;
    animation: spin .8s linear infinite;
  }
  
  @-webkit-keyframes spin {
    0% { -webkit-transform: rotate(0deg); }
    100% { -webkit-transform: rotate(360deg); }
  }
  
  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }
</style>
<div class="loader-container">
    <div class="loader"></div>
</div>

<script>
setTimeout(function() {
    loadVaults();
}, 2000)
function loadVaults() {
    window.parent.loadVaults();
}
</script>
