<?php
Yii::app()->clientScript
    ->addPackage('client', array(
        'basePath'=> '_geolocation.views.default', 
        'js'      => array( 'js/client.js' ),
        'depends' => array( 'geolocationClient' ),
    ))
    ->registerPackage('client');
?>
<p>Click the button to start watching your position:</p>
<button id="btnStart">Start</button>

<p>Click the button to stop watching your position:</p>
<button id="btnStop">Stop</button>
