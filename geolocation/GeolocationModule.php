<?php

class GeolocationModule extends CWebModule
{
    /**
     * Name of the component implementing the geolocation interface
     */
    public $geolocationId = 'geolocation';
    
    ///////////////////////////////////////////////////////////////////////////

    /**
     * Constructor.
     * @param string $id the ID of this module
     * @param CModule $parent the parent module (if any)
     * @param mixed $config the module configuration. It can be either an array or
     * the path of a PHP file returning the configuration array.
     */
    public function __construct($id,$parent,$config=null)
    {
        Yii::setPathOfAlias( '_geolocation', __DIR__ );
        $this->setComponents( $this->getDefaultComponentsConfiguration() );
        parent::__construct( $id, $parent, $config );
    }
    
    ///////////////////////////////////////////////////////////////////////////
    
    protected function init()
    {
        Yii::setPathOfAlias( 'thrift', __DIR__.'/../vendor/thrift' );
        
        Yii::app()->clientScript
            ->addPackage('thrift', array(
               'basePath'=> 'thrift', 
               'js'      => array( 'js/thrift.js' ),
               'depends' => array( 'jquery' ),
            ))
            ->addPackage('geolocationClient', array(
               'basePath'=> '_geolocation.thrift', 
               'js'      => array( 'gen-js/Geolocation.js', 'gen-js/geolocation_types.js' ),
               'depends' => array( 'thrift' ),
            ));
    }
    
    ///////////////////////////////////////////////////////////////////////////
    
    public function getDefaultComponentsConfiguration()
    {
        return array(
            $this->geolocationId => array(
                'class' => '_geolocation.components.GeolocationService',
            ),
        );
    }
    
    ///////////////////////////////////////////////////////////////////////////
    
}
