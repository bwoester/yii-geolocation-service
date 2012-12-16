<?php

// TODO: cleanup

Yii::import( 'thrift.php.Thrift.ClassLoader.ThriftClassLoader', true );

$loader = new \Thrift\ClassLoader\ThriftClassLoader();
$loader->registerNamespace( 'Thrift', Yii::getPathOfAlias('thrift.php') );
$loader->register();

Yii::import( '_geolocation.thrift.gen-php.bwoester.geolocation.Geolocation', true );
Yii::import( '_geolocation.thrift.gen-php.bwoester.geolocation.Types', true );

class GeolocationService extends CApplicationComponent implements \bwoester\geolocation\GeolocationIf
{

    ///////////////////////////////////////////////////////////////////////////

    public function addPosition($id, \bwoester\geolocation\Position $position)
    {
      return true;
    }

    ///////////////////////////////////////////////////////////////////////////

    public function batchAddPositions($id, $positions)
    {
      return true;
    }

    ///////////////////////////////////////////////////////////////////////////

    public function streamPosition($id, \bwoester\geolocation\Position $position)
    {
      $this->addPosition( $id, $position );
    }

    ///////////////////////////////////////////////////////////////////////////

    public function batchStreamPositions($id, $positions)
    {
      $this->batchAddPositions( $id, $positions );
    }

    ///////////////////////////////////////////////////////////////////////////

}
