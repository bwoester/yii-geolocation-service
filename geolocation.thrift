// html5 geolocation interfaces:
//
// @see "http://www.w3.org/TR/geolocation-API/#coordinates_interface"
// interface Coordinates {
//   readonly attribute double latitude;
//   readonly attribute double longitude;
//   readonly attribute double? altitude;
//   /**
//    * @var accuracy, denotes the accuracy level of the latitude and longitude
//    *      coordinates. It is specified in meters and must be supported by
//    *      all implementations. The value of the accuracy attribute must be a
//    *      non-negative real number.
//    */
//   readonly attribute double accuracy;
//   readonly attribute double? altitudeAccuracy;
//   readonly attribute double? heading;
//   readonly attribute double? speed;
// };
//
// @see "http://www.w3.org/TR/DOM-Level-3-Core/core.html#Core-DOMTimeStamp"
// typedef unsigned long long DOMTimeStamp;
//
// @see "http://www.w3.org/TR/geolocation-API/#position_interface"
// interface Position {
//   readonly attribute Coordinates coords;
//   readonly attribute DOMTimeStamp timestamp;
// };

struct Coordinates {
    1: required double latitude;
    2: required double longitude;
    3: optional double altitude;
    4: required double accuracy;
    5: optional double altitudeAccuracy;
    6: optional double heading;
    7: optional double speed;
}

typedef i64 DateTime

struct Position {
    1: required Coordinates coords;
    2: optional DateTime timestamp;
}

typedef list<Position> Positions
typedef string Uuid
typedef Uuid UserSessionId


service Geolocation {

    /**
     * Add a single position. Result of the operation will be returned by the
     * service, so the client can retry on error.
     */
    bool addPosition( 1:UserSessionId id, 2:Position position );
    /**
     * Add a list of positions. Result of the operation will be returned by the
     * service, so the client can retry on error.
     */
    bool batchAddPositions( 1:UserSessionId id, 2:Positions positions );

    /**
     * Stream a single position. Service won't return any result. Can be used
     * if it isn't important whether the position will actually be stored or
     * not.
     */
    void streamPosition( 1:UserSessionId id, 2:Position position );
    /**
     * Stream a list of positions. Service won't return any result. Can be used
     * if it isn't important whether the position will actually be stored or
     * not.
     */
    void batchStreamPositions( 1:UserSessionId id, 2:Positions positions );

}
