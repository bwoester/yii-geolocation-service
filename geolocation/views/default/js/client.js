(function($){
$(function() {

    var transport = new Thrift.Transport( "http://yii-geolocation-service.bwoester.c9.io/geolocationSampleApp/index.php?r=geolocation" );
    var protocol  = new Thrift.Protocol(transport);
    var client    = new GeolocationClient(protocol);

    var generateUuid = function() {
        return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
            var r = Math.random()*16|0, v = c == 'x' ? r : (r&0x3|0x8);
            return v.toString(16);
        });        
    }
    
    var clientUuid  = generateUuid();
    var watchId     = 0;

    var successCallback = function( position )
    {
        var c = new Coordinates();
        c.latitude          = position.coords.latitude;
        c.longitude         = position.coords.longitude;
        c.altitude          = position.coords.altitude;
        c.accuracy          = position.coords.accuracy;
        c.altitudeAccuracy  = position.coords.altitudeAccuracy;
        c.heading           = position.coords.heading;
        c.speed             = position.coords.speed;
        
        var p = new Position();
        p.coords = c;
        p.timestamp = position.timestamp;
        
        try
        {
            var result = client.addPosition( clientUuid, p );
        }
        catch (ex)
        {
            console.log( ex.message );
        }
    }
    
    var errorCallback = function( positionError ) {
        console.log( positionError.message );
    }
    
    var options = {
        'enableHighAccuracy': true,
        'timeout'           : 60000,
        'maximumAge'        : 60000
    };

    $("#btnStart").on("click", function()
    {
        watchId = navigator.geolocation.watchPosition(
            successCallback, errorCallback, options
        );
        $("#btnStart").attr( "disabled", "disabled" );
        $("#btnStop").removeAttr("disabled");
    });
    
    $("#btnStop").on("click", function() {
        navigator.geolocation.clearWatch( watchId );
        $("#btnStop").attr( "disabled", "disabled" );
        $("#btnStart").removeAttr("disabled");
    });
    
    $("#btnStop").attr( "disabled", "disabled" );
});
})( jQuery );
