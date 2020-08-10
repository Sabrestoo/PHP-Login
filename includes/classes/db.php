<?php


if (!defined('__CONFIG__')) {
    //Redirect or 404 page here instead of exit
    exit('You do not have a config file');
}

class DB {
    
    protected static $conn;

    private function __construct() {

       try {
           
           self::$conn = new PDO("mysql:host=localhost;dbname=login_course", 'root', 'mysql');
           self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           self::$conn->setAttribute(PDO::ATTR_PERSISTENT, false);
           
       } catch (PDOException $e) {

           die('Could not connect to database' . $e->getMessage()); 
           
       }
    }

    public static function get_connection() {
        if(!self::$conn){
            new DB();
        }

        return self::$conn;
    }

}
