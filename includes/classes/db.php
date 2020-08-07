<?php

class DB {
    
    protected static $conn;
    private $pass = 'mysql';
    private $user = 'root';

    private function __construct() {

       try {
           self::$conn = new PDO("mysql:host=localhost;dbname=login_course", self::$user, self::$pass);
           self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           self::$conn->setAttribute(PDO::ATTR_PERSISTENT, false);
           
       } catch (PDOException $e) {
           die('Could not connect to database' . $e->getMessage()); 
           
       }
    }

    public function get_connection() {
        if(!self::$conn){
            new DB();
        }

        return self::$conn;
    }

}
