<?php
error_reporting(-1);
ini_set('display_errors', 'On');
class Db{

    private static $instance = NULL;


    private function __construct() {
    }

    /**
    *
    * Return DB instance or create intitial connection
    *
    * @return object (PDO)
    *
    * @access public
    *
    */
    public static function getInstance() {

    if (!self::$instance)
        {
        self::$instance = new PDO('sqlite:game.db');
        self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    return self::$instance;
    }


    private function __clone(){
    }

}

?>
