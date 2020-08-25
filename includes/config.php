<?php

if (!defined('__CONFIG__')) {
    //Redirect or 404 page here instead of exit
    exit('You do not have a config file');
}
if(!isset($_SESSION)){
session_start();
}
require 'classes/db.php';

$conn = DB::get_connection();