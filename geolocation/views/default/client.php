<?php

// TODO: autoupdate on change? tired of deleting assets each time i modified my code...
Yii::app()->clientScript
    ->addPackage('client', array(
        'basePath'=> '_geolocation.views.default.js', 
        'js'      => array( 'client.js' ),
        'depends' => array( 'geolocationClient' ),
    ))
    ->addPackage('google.maps', array(
        'baseUrl'=> 'https://maps.google.com/maps/api',
        'js'      => array( 'js?sensor=true' ),
    ))
    ->registerPackage('client')
    ->registerPackage('google.maps');
?>
<p>Click the button to start watching your position:</p>
<button id="btnStart">Start</button>

<p>Click the button to stop watching your position:</p>
<button id="btnStop">Stop</button>

<div id="map_canvas" style="width:100%; height:300px"></div>